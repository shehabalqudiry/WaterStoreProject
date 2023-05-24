<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RepoInterface\Store\ProductInterface;



class ProductController extends Controller
{

    protected $ProductInterface;

    public function __construct(ProductInterface $ProductInterface)
    {
        $this->ProductInterface = $ProductInterface;
    }

    public function index(Request $request)
    {
        return $this->ProductInterface->index($request);
    }

    public function create()
    {
        return $this->ProductInterface->create();
    }

    public function store(Request $request)
    {
        return $this->ProductInterface->store($request);
    }

    public function show(Product $product)
    {
        return $this->ProductInterface->show($product);
    }

    public function edit(Product $product)
    {
        return $this->ProductInterface->edit($product);
    }

    public function update(Request $request, Product $product)
    {
        return $this->ProductInterface->update($request, $product);
    }

    // public function updateStatus(Request $request, Product $product)
    // {
    //     return $this->ProductInterface->updateStatus($request, $product);
    // }

    // public function uploadToServer(Request $request)
    // {
    //     return $this->ProductInterface->uploadToServer($request);
    // }

    public function destroy(Product $product)
    {
        return $this->ProductInterface->destroy($product);
    }
}