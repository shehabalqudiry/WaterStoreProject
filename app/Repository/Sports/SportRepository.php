<?php

namespace App\Repository\Sports;

use App\Models\Sport;
use Illuminate\Http\Request;
use App\RepoInterface\Sports\SportInterface;
use Illuminate\Support\Facades\Validator;


class SportRepository implements SportInterface
{
    public function index($request)
    {
        $sports = Sport::where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
            if ($request->q!=null) {
                $q->where('title', 'LIKE', '%'.$request->q.'%');
            }
        })->latest()->paginate();
        return view('admin.sports.index', compact('sports'));
    }


    public function create()
    {
        return view('admin.sports.create');
    }

    public function store($request)
    {
        $rules = [
            'title'=>"required|max:255",
            'photo'=>"required|mimes:png,jpg,svg,jpeg,webp|max:2048",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $sport = Sport::create([
                "title"=>$request->title,
                "photo"=> $request->photo ? uploadImage("users", $request->photo) : "default.png",
            ]);

            if (!$sport) {
                flash()->error('حدث خطأ اثناء انشاء الحساب','عملية فاشلة');
                return back();
            }
            flash()->success('تم إضافة المستخدم','عملية ناجحة');
            return redirect()->route('admin.sports.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(),'عملية فاشلة');
            return back();
        }
    }

    public function show($sport)
    {
        return view('admin.sports.show', compact('sport'));
    }

    public function edit($sport)
    {
        return view('admin.sports.edit', compact('sport'));
    }

    public function update($request, $sport)
    {
        $rules = [
            'title'=>"required|max:255",
            'photo'=>"nullable|mimes:png,jpg,svg,jpeg|max:2048",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $sport->update([
                "title"          => $request->title,
                "photo"         => $request->photo ? uploadImage("users", $request->photo) : $sport->photo,
            ]);

            flash()->success('تم تعديل بيانات المستخدم','عملية ناجحة');
            return redirect()->route('admin.sports.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(),'عملية فاشلة');
            return back();
        }
    }

    public function destroy($sport)
    {

    }
}
