<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $sliders =  Slider::where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
            if ($request->q!=null) {
                $q->where('link', 'LIKE', '%'.$request->q.'%');
            }
        })->orderBy('id', 'DESC')->get();

        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');
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
            'url'=>"required|url",
        ]);
        try {
            $slider = Slider::create([
                "title"=>$request->title,
                "description"=>$request->description,
                "status"=>$request->status,
                "url"=>$request->url,
            ]);


            if ($request->hasFile('image')) {
                $slider->update(['image'=> uploadImage('sliders', $request->image)]);
            }
            flash()->success('تم إضافة الاعلان بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.sliders.index');
        } catch (\Exception $e) {
            flash()->success($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'url'=>"required|url",
        ]);
        try {
            $slider->update([
                "title"=>$request->title,
                "description"=>$request->description,
                "status"=>$request->status,
                "url"=>$request->url,
            ]);
            if ($request->hasFile('image')) {
                deleteFile('sliders', $slider->id, 'image');
                $slider->update(['image'=> uploadImage('sliders', $request->image)]);
            }
            flash()->success('تم تحديث الاعلان بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.sliders.index');
        } catch (\Exception $e) {
            flash()->success($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        flash()->success('تم حذف الاعلان بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.sliders.index');
    }
}
