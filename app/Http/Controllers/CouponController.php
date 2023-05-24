<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'=>"required",
            'value'=>"required",
        ]);

        Coupon::create([
            "coupon_code"=>$request->code,
            "value"=>$request->value,
            "number"=>$request->number,
        ]);

        flash()->success('تم إضافة الكوبون بنجاح', 'عملية ناجحة');
        return back();
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code'=>"required",
            'value'=>"required",
        ]);

        $coupon->update([
            "coupon_code"=>$request->code,
            "value"=>$request->value,
            "number"=>$request->number,
        ]);

        flash()->success('تم تعديل الكوبون بنجاح', 'عملية ناجحة');
        return back();
    }

    public function destroy(Request $request, Coupon $coupon)
    {
        $coupon->delete();
        flash()->success('تم حذف الكوبون بنجاح', 'عملية ناجحة');
        return back();
    }

}
