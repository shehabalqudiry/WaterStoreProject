<?php

namespace App\Repository\APIs;

use App\Models\Product;
use App\Traits\GeneralTrait;
use App\RepoInterface\APIs\StoreAPIInterface;

use Illuminate\Support\Facades\Validator;

class StoreAPIRepository implements StoreAPIInterface
{
    use GeneralTrait;

    public function products($request)
    {
        $data = Product::where('status', 0)->where(function ($q) use ($request) {

            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
            if ($request->company_id !== null) {
                $q->where('company_id', $request->company_id);
            }

            if ($request->productType !== null) {
                $q->where('type', $request->productType);
            }

            if ($request->q !== null) {
                $q->whereLike('title', "%$request->q%")->orWhereLike('description', "%$request->q%");
            }
        })->latest()->get();

        return $this->returnData('data', $data, '');
    }
}
