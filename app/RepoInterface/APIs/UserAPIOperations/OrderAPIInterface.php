<?php

namespace App\RepoInterface\APIs\UserAPIOperations;

interface OrderAPIInterface
{
    public function cart_count($request);
    public function cart($request);
    public function add_to_cart($request);
    public function favorite_order($request);
    public function cancel_order($request);
    public function orders($request);
    public function make_order($request);
    public function checkCoupon($request);
}