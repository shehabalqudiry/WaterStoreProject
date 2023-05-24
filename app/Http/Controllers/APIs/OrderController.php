<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\APIs\LoginRequest;

use App\Http\Requests\APIs\RegisterRequest;
use App\RepoInterface\APIs\UserAPIOperations\OrderAPIInterface;

class OrderController extends Controller
{
    protected $orderInterface;

    public function __construct(OrderAPIInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    }


    public function cart_count(Request $request)
    {
        return $this->orderInterface->cart_count($request);
    }

    public function cart(Request $request)
    {
        return $this->orderInterface->cart($request);
    }

    public function add_to_cart(Request $request)
    {
        return $this->orderInterface->add_to_cart($request);
    }

    public function favorite_order(Request $request)
    {
        return $this->orderInterface->favorite_order($request);
    }

    public function cancel_order(Request $request)
    {
        return $this->orderInterface->cancel_order($request);
    }

    public function orders(Request $request)
    {
        return $this->orderInterface->orders($request);
    }

    public function make_order(Request $request)
    {
        return $this->orderInterface->make_order($request);
    }
    public function checkCoupon(Request $request)
    {
        return $this->orderInterface->checkCoupon($request);
    }
}