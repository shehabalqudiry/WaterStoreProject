<?php

namespace App\Http\Controllers\APIs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\APIs\LoginRequest;
use App\RepoInterface\APIs\StoreAPIInterface;
use App\Http\Requests\APIs\RegisterRequest;

class StoreController extends Controller
{
    protected $storeInterface;

    public function __construct(StoreAPIInterface $storeInterface)
    {
        return $this->storeInterface = $storeInterface;
    }


    public function categories(Request $request)
    {
        return $this->storeInterface->categories($request);
    }

    public function products(Request $request)
    {
        return $this->storeInterface->products($request);
    }


}
