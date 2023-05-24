<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepoInterface\Store\OrderInterface;



class OrderController extends Controller
{
    protected $orderInterface;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    }


    public function index(Request $request)
    {
        return $this->orderInterface->index($request);
    }

    public function update(Order $order, Request $request)
    {
        return $this->orderInterface->updateStatus($order, $request);
    }

    public function show(Order $order, Request $request)
    {
        return $this->orderInterface->show($order, $request);
    }

    public function destroy(Order $order, Request $request)
    {
        return $this->orderInterface->destroy($order, $request);
    }
}