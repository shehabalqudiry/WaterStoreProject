<?php

namespace App\Repository\APIs\UserAPIOperations;

use App\Models\Cart;
use App\Models\Video;
use App\Models\Coupon;
use App\Models\CartItem;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\RepoInterface\APIs\UserAPIOperations\OrderAPIInterface;

class OrderAPIRepository implements OrderAPIInterface
{
    use GeneralTrait;

    public function cart_count($request)
    {
        if (!$request->user()->cart()) {
            $request->user()->cart->create();
        }
        $cart_count = $request->user()->cart->items()->count();


        $data = $cart_count;

        return $this->returnData('data', $data, 'عربة التسوق');
    }

    public function cart($request)
    {
        if (!$request->user()->cart) {
            Cart::create([
                'user_id' => $request->user()->id
            ]);
        }
        // return $request->user()->cart;
        $cart_items = CartItem::where('cart_id', $request->user()->cart->id)->where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
        })->with('product')->latest()->get();

        foreach ($cart_items as $item) {
            $item->product->price = ($item->product->discount_price ? $item->product->discount_price : $item->product->price);
        }

        $data = [
            'cart_items' => $cart_items,
            'total_without_vat' => $request->user()->cart->total_without_vat,
            'vat' => $request->user()->cart->vat,
            'cart_total' => $request->user()->cart->total,
        ];

        return $this->returnData('data', $data, 'عربة التسوق');
    }
    public function add_to_cart($request)
    {
        if (!$request->user()->cart) {
            Cart::create([
                'user_id' => $request->user()->id
            ]);
        }
        if ($request->delete == true) {
            $product = $request->user()->cart->items->where('id', $request->item_id)->first();
            if ($product) {
                $product->delete();
                return $this->returnSuccessMessage('تم حذف المنتج من عربة التسوق بنجاح', "CART19");
            }
            return $this->returnSuccessMessage('تم حذف المنتج من عربة التسوق مسبقاً', "CART19");
        }
        $rules = [
            'product_id'=>"required|exists:products,id",
            'quantity'=>"required",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError("0000", $validator->errors()->first());
        }

        $product = $request->user()->cart->items->where('product_id', $request->product_id)->first();
        if ($product) {
            if ($product->quantity + $request->quantity < 1) {
                $product->delete();
                return $this->returnSuccessMessage('تم حذف المنتج من عربة التسوق بنجاح', "CART19");
            } else {
                $product->update(['quantity' => $product->quantity + $request->quantity]);
                if ($request->quantity == '-1') {
                    return $this->returnSuccessMessage('تم', "CART19");
                }
                return $this->returnSuccessMessage('تم إضافة المنتج إلي عربة التسوق بنجاح', "CART11");
            }
        } else {
            $request->user()->cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'mosque_name' => $request->mosque_name,
                'mosque_lat' => $request->mosque_lat,
                'mosque_long' => $request->mosque_long,
            ]);
            return $this->returnSuccessMessage('تم إضافة المنتج إلي عربة التسوق بنجاح', "CART11");
        }
    }

    public function favorite_order($request)
    {
        $rules = [
            'order_id'=>"required|exists:orders,id",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError("0000", $validator->errors()->first());
        }

        $order = $request->user()->orders()->where('id', $request->order_id)->first();
        if ($order->is_favorite == 0) {
            $order->update(['is_favorite' => 1]);
            return $this->returnSuccessMessage('تم إضافة الطلب إلي المفضلة', "CART11");
        }elseif ($order->is_favorite == 1) {
            $order->update(['is_favorite' => 0]);
            return $this->returnSuccessMessage('تم ازالة الطلب من المفضلة', "CART11");
        }

    }

    public function cancel_order($request)
    {
        $rules = [
            'order_id'=>"required|exists:orders,id",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError("0000", $validator->errors()->first());
        }

        $order = $request->user()->orders()->where('id', $request->order_id)->first();

        if ($order->status == 4) {
            return $this->returnData('data', $order,'تم إلغاء الطلب مسبقاً');
        }elseif ($order) {
            $order->update(['status' => 4]);
            return $this->returnData('data', $order,'تم إلغاء الطلب');
        }

    }

    public function make_order($request)
    {
        $rules = [
            'address_id'=>"required",
            'payment_id'=>"nullable",
            'times'=>"required|in:0,1,2",
            'delivery_time'=>"required|in:any_time,AM,PM",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError("0000", $validator->errors()->first());
        }
        $user = $request->user();
        if($user->deleted_at != null)
        {
            $errormessage = 'تم إيقاف الحساب';
            return $this->returnError('019',$errormessage);
        }
        if($user->status != 1)
        {
            $errormessage = 'تم إيقاف الحساب مؤقتا تواصل مع الادارة لحل الامر';
            return $this->returnError('020',$errormessage);
        }
        $items = $user->cart->items()->get();

        if (!$items->count()) {
            return $this->returnError("ORDER00", 'عربة التسوق فارغة');
        }
        foreach ($items as $item) {
            $item->total = $item->quantity * ($item->product->discount_price ? $item->product->discount_price : $item->product->price);
        }

        $total = $items->sum('total');

        $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();

        if ($coupon) {
            if ($coupon->number <= 0) {
                return $this->returnError(200, 'تم بلوغ الحد الاقصى من استخدام هذا الكوبون');
            }
            //check if user used this code before
            $checkUsed = DB::table('user_coupons')->where('user_id', $request->user()->id)->where('coupon_id', $coupon->id)->first();

            if (!$checkUsed) {
                //no quantity after update
                $discount = $coupon->value;
                $total = $total - $discount;
                //update coupon times
                $number = Coupon::find($coupon->id);
                $number->update([
                    'number' => $coupon->number - 1
                ]);
                $checkUsed = DB::table('user_coupons')->insert(['user_id' => $request->user()->id, 'coupon_id' => $coupon->id]);
            } else {
                return $this->returnError(502, 'لقد قمت باستخدام هذا الكوبون من قبل');
            }
        }


        $order = $user->orders()->create([
            'number' => $this->generateOrderNumber(),
            'total'  => $total,
            'coupon_id'  => $coupon->id ?? null,
            'address_id'  => $request->address_id,
            'payment_id'  => $request->payment_id,
            'times'  => $request->times,
            'delivery_time'  => $request->delivery_time,
        ]);

        foreach ($items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'mosque_name' => $item->mosque_name,
                'mosque_lat' => $item->mosque_lat,
                'mosque_long' => $item->mosque_long,
            ]);
            $item->delete();
        }
        return $this->returnData('data', $order, 'تم تنفذ الطلب بنجاح');
    }


    public function orders($request)
    {
        if ($request->order_id) {
            $data = $request->user()->orders()->where('id', $request->order_id)->with('items', 'address')->latest()->first();
        }else {
            $data = [
                "current_orders" => $request->user()->orders()->where('status', 0)->with('items', 'address')->latest()->get(),
                "previous_orders" => $request->user()->orders()->where('status', 3)->with('items', 'address')->latest()->get(),
                "cancel_orders" => $request->user()->orders()->where('status', 4)->with('items', 'address')->latest()->get(),
                "favorite_orders" => $request->user()->orders()->where('is_favorite', 1)->with('items', 'address')->latest()->get(),
            ];
        }
        return $this->returnData('data', $data, 'الطلبات');
    }

    public function checkCoupon($request)
    {
        //rules for validation
        $rules = [
            'coupon_code' => 'required',
        ];

        //validation
        $validator = validator()->make($request->all(), $rules);

        //validation failure

        if ($validator->fails()) {
            return $this->returnError("0000", $validator->errors()->first());
        }

        $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();

        if ($coupon) {
            //check if user used this code before
            $checkUsed = DB::table('user_coupons')->where('user_id', $request->user()->id)->where('coupon_id', $coupon->id)->first();

            if (!$checkUsed) {
                //no quantity after update
                $discount = $coupon->value;

                return $this->returnData('data', [
                    'discount' => $discount
                ], 'الكود الذي ادخلته صحيح');
            } else {
                return $this->returnData('data', [
                    'discount' => 0
                ], 'لقد قمت باستخدام هذا الكوبون من قبل');
            }
        } else {
            return $this->returnData('data', [
                'discount' => 0
            ], 'الكوبون الذي ادخلته غير صحيح');
        }
    } //end of check coupon
}
