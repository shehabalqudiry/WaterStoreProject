<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $offers =  Offer::where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
        })->orderBy('id', 'DESC')->get();

        return view('admin.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'image'=>"required|image",
            'price_in_offer'=>"required",
        ]);
        try {
            $offer = Offer::create([
                "title"=>$request->title,
                "description"=>$request->description,
                "status"=>$request->status,
                "price_in_offer"=>$request->price_in_offer,
                "product_id"=>$request->product_id,
            ]);


            if ($request->hasFile('image')) {
                $offer->update(['image'=> uploadImage('offers', $request->image)]);
            }
            flash()->success('تم إضافة الاعلان بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.offers.index');
        } catch (\Exception $e) {
            flash()->success($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        return view('admin.offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'image'=>"required|image",
            'price_in_offer'=>"required",
        ]);
        try {
            $offer->update([
                "title"=>$request->title,
                "description"=>$request->description,
                "status"=>$request->status,
                "price_in_offer"=>$request->price_in_offer,
                "product_id"=>$request->product_id,

            ]);
            if ($request->hasFile('image')) {
                deleteFile('offers', $offer->id, 'image');
                $offer->update(['image'=> uploadImage('offers', $request->image)]);
            }
            flash()->success('تم تحديث الاعلان بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.offers.index');
        } catch (\Exception $e) {
            flash()->success($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        flash()->success('تم حذف الاعلان بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.offers.index');
    }
}
