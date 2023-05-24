<?php

namespace App\Repository\Store;

use App\Models\Product;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use App\RepoInterface\Store\ProductInterface;
use Illuminate\Support\Facades\Validator;
use ParagonIE\Sodium\Compat;

class ProductRepository implements ProductInterface
{
    public function index($request)
    {
        $products =  Product::where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
            if ($request->q!=null) {
                $q->where('title', 'LIKE', '%'.$request->q.'%')->orWhere('description', 'LIKE', '%'.$request->q.'%');
            }
        })->orderBy('id', 'DESC')->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $companies= Company::orderBy('id', 'DESC')->get();
        return view('admin.products.create', compact('companies'));
    }

    public function store($request)
    {
        $request->validate([
            'company_id'=>"required|exists:companies,id",
            'status'=>"required|in:0,1",
            'type'=>"required|in:0,1",
            'title'=>"required|max:190",
            'price'=>"required",
            'description'=>"nullable|max:100000",
        ]);
        $product = Product::create([
            "price"=>$request->price,
            "discount_price"=>$request->discount_price,
            "company_id"=>$request->company_id,
            "status"=>$request->status ?? 0,
            "min"=>$request->min,
            "max"=>$request->max,
            "type"=>$request->type,
            "title"=>$request->title,
            "description"=>$request->description,
        ]);

        if ($request->hasFile('main_image')) {
            $product->update(['main_image'=> uploadImage('products', $request->main_image)]);
        }
        flash()->success('تم إضافة المنتج بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.products.index');
    }


    public function show($product)
    {
    }


    public function edit($product)
    {
        $companies= Company::orderBy('id', 'DESC')->get();
        return view('admin.products.edit', compact('product', 'companies'));
    }

    public function update($request, $product)
    {

        $request->validate([
            'company_id'=>"required|exists:companies,id",
            'status'=>"required|in:0,1",
            'type'=>"required|in:0,1",
            'title'=>"required|max:190",
            'price'=>"required",
            'description'=>"nullable|max:100000",
        ]);
        $product->update([
            "price"=>$request->price,
            "discount_price"=>$request->discount_price,
            "company_id"=>$request->company_id,
            "status"=>$request->status ?? 0,
            "type"=>$request->type,
            "title"=>$request->title,
            "description"=>$request->description,
            "min"=>$request->min,
            "max"=>$request->max,
        ]);
        if ($request->hasFile('main_image')) {
            deleteFile('products', $product->id, 'main_image');
            $product->update(['main_image'=> uploadImage('products', $request->main_image)]);
        }
        flash()->success('تم تحديث المنتج بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.products.index');
    }

    public function destroy($product)
    {
        $product->delete();
        flash()->success('تم حذف المنتج بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.products.index');
    }
}
