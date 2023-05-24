<?php

namespace App\Repository\Store;

use App\Models\Order;
use App\Models\Video;
use App\Traits\GeneralTrait;

use Illuminate\Support\Facades\Validator;
use App\RepoInterface\Store\OrderInterface;

class OrderRepository implements OrderInterface
{
    public function index($request)
    {
        $orders = Order::where(function ($q) use ($request) {
            if ($request->q!=null) {
                $q->where('number', $request->q);
            }
            if ($request->ordersType !== null && $request->ordersType != 'all') {
                $q->where('status', intval($request->ordersType));
            }
        })->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }
    public function updateStatus($order, $request)
    {
        try {
            $order->update(['status' => $request->status]);
            flash()->success('تم تحديث الحالة بنجاح', 'عملية ناجحة');
            return back();
        } catch (\Exception $e) {
            flash()->success($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }
    public function show($order, $request)
    {
        return view('admin.orders.show', compact('order'));
    }
    public function destroy($order, $request)
    {
    }
}
