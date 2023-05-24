<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Mosque;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MosqueController extends Controller
{
    public function index(Request $request)
    {
        $mosques =  Mosque::where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
        })->orderBy('id', 'DESC')->get();

        return view('admin.mosques.index', compact('mosques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mosques.create');
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
            'name'=>"required",
        ]);
        try {
            $mosque = Mosque::create([
                "name"=>$request->name,
                "long"=>$request->long,
                "lat"=>$request->lat,
            ]);


            if ($request->hasFile('image')) {
                $mosque->update(['image'=> uploadImage('mosques', $request->image)]);
            }
            flash()->success('تم إضافة المسجد بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.mosques.index');
        } catch (\Exception $e) {
            flash()->success($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function edit(Mosque $mosque)
    {
        return view('admin.mosques.edit', compact('mosque'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mosque $mosque)
    {
        $request->validate([
            'name'=>"required",
        ]);
        try {
            $mosque->update([
                "name"=>$request->name,
                "long"=>$request->long,
                "lat"=>$request->lat,

            ]);
            if ($request->hasFile('image')) {
                deleteFile('mosques', $mosque->id, 'image');
                $mosque->update(['image'=> uploadImage('mosques', $request->image)]);
            }
            flash()->success('تم تحديث المسجد بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.mosques.index');
        } catch (\Exception $e) {
            flash()->success($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mosque  $mosque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mosque $mosque)
    {
        $mosque->delete();
        flash()->success('تم حذف المسجد بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.mosques.index');
    }
}
