<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::get();
        return view('admin.cities.index', compact('cities'));
    }

    public function store(Request $request)
    {
        City::create(['name' => $request->name]);
        return back();
    }

    public function update(Request $request, City $city)
    {
        $city->update(['name' => $request->name]);
        return back();
    }

    public function destroy(Request $request)
    {
        # code...
    }
}
