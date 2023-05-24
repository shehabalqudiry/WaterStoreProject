<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Imports\ProjectImport;
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::where(function($q)use($request){
            if($request->city!=null)
                $q->where('city_id',$request->city);

            if($request->type!=null)
                $q->where('type_id',$request->type);
        })->latest()->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        Excel::import(new ProjectImport($request->city_id, $request->type_id), $request->fileImport);

        return redirect('/')->with('success', 'All good!');
    }
}