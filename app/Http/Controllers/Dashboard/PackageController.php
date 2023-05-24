<?php

namespace App\Http\Controllers;

use App\Models\Package as package;
use Illuminate\Http\Request;

class PackageController extends Controller
{

    public function __construct()
    {
        // $this->authorizeResource(package::class, 'package');
    }
    public function index(Request $request)
    {

        $packages =  package::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('title','LIKE','%'.$request->q.'%')->orWhere('description','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();

        return view('admin.packages.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'                 => "required|string|max:255",
            'description'           => "nullable|string|max:255",
            'price'                 => "required|numeric",
            'announcement_number'   => "nullable|numeric",
            'time'                  => "nullable|numeric",
        ]);
        $package = package::create([
            'title'                 => $request->title,
            'description'           => $request->description,
            'price'                 => $request->price,
            'announcement_number'   => $request->announcement_number,
            'time'                  => $request->time,
        ]);

        flash()->success('تم بنجاح','عملية ناجحة');
        return redirect()->route('admin.packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, package $package)
    {
        $packages =  package::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('title','LIKE','%'.$request->q.'%')->orWhere('description','LIKE','%'.$request->q.'%');
        })->orderBy('id','DESC')->paginate();

        return view('admin.packages.index',compact('packages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(package $package)
    {
        return view('admin.packages.edit',compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, package $package)
    {
        $request->validate([
            'title'                 => "required|string|max:255",
            'description'           => "nullable|string|max:255",
            'price'                 => "required|numeric",
            'announcement_number'   => "nullable|numeric",
            'time'                  => "nullable|numeric",
        ]);

        $package->update([
            'title'                 => $request->title,
            'description'           => $request->description,
            'price'                 => $request->price,
            'announcement_number'   => $request->announcement_number,
            'time'                  => $request->time,
        ]);

        flash()->success('تم تحديث بنجاح','عملية ناجحة');
        return redirect()->route('admin.packages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(package $package)
    {
        try {
            $package->delete();
            flash()->success('تم حذف بنجاح','عملية ناجحة');
            return redirect()->route('admin.packages.index');
        } catch (\Exception $ex) {
            flash()->error($ex->getMessage(),'عملية فاشلة');
            return redirect()->route('admin.packages.index');
        }

    }
}
