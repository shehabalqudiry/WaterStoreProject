<?php

namespace App\RepoInterface\Store;

interface OrderInterface
{
    public function index($request);
    public function updateStatus($order, $request);
    public function show($order, $request);
    public function destroy($order, $request);
}
