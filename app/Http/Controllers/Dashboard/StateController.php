<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(State::class, 'State');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $states =  State::where("city_id", $request->city_id)->where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
            if ($request->q!=null) {
                $q->where('name', 'LIKE', '%'.$request->q.'%');
            }
        })->orderBy('id', 'DESC')->paginate();

        return view('admin.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.states.create');
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
            'name'=> "required|string|max:255",
            'status'=>"required|in:0,1",
        ]);
        $state = State::create([
            "name"=>$request->name,
            "status"=>$request->status,
            "city_id"=> $request->city_id,
        ]);

        flash()->success('تم إضافة المنطقة/المحافظة/الحي بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.states.index', ['city_id' => $request->city_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */

    public function edit(State $state)
    {
        $cities = City::where('country_id', $state->city->country_id)->get();
        return view('admin.states.edit', compact('cities','state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'name'=> "required|string|max:255",
            'city_id'=>"required",
            'status'=>"required|in:0,1",
        ]);

        $state->update([
            "name"=>$request->name,
            "status"=>$request->status,
            "city_id"=> $request->city_id,
        ]);

        flash()->success('تم تحديث المنطقة/المحافظة/الحي بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.states.index', ['city_id' => $request->city_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        try {
            $state->states()->delete();
            $state->delete();
            flash()->success('تم حذف المنطقة/المحافظة/الحي بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.states.index');
        } catch (\Exception $ex) {
            flash()->error($ex->getMessage(), 'عملية فاشلة');
            return redirect()->route('admin.states.index');
        }
    }
}
