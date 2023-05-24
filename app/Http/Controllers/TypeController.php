<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::get();
        return view('admin.types.index', compact('types'));
    }

    public function store(Request $request)
    {
        Type::create(['name' => $request->name]);
        return back();
    }

    public function update(Request $request, Type $type)
    {
        $type->update(['name' => $request->name]);
        return back();
    }

    public function destroy(Request $request)
    {
        # code...
    }
}
