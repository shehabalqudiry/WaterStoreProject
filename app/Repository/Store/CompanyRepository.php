<?php

namespace App\Repository\Store;

use App\Models\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\RepoInterface\Store\CompanyInterface;


class CompanyRepository implements CompanyInterface
{
    public function index($request)
    {
        $companies =  Company::where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
            if ($request->q!=null) {
                $q->where('title', 'LIKE', '%'.$request->q.'%')->orWhere('description', 'LIKE', '%'.$request->q.'%');
            }
        })->orderBy('id', 'DESC')->paginate();

        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store($request)
    {
        $request->validate([
            'title'=>"required|max:190",
            'description'=>"nullable|max:10000",
        ]);
        try {
            DB::beginTransaction();

            $company = Company::create([
                "title"=>$request->title,
                "description"=>$request->description,
            ]);
            if ($request->hasFile('image')) {
                $company->update(['image'=> uploadImage('companies', $request->image)]);
            }
            DB::commit();
            flash()->success('تم إضافة القسم بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.companies.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash()->success($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    public function show($request, $company)
    {
        $companies =  Company::where('parent_id', $company->id)->where(function ($q) use ($request) {
            if ($request->id!=null) {
                $q->where('id', $request->id);
            }
            if ($request->q!=null) {
                $q->where('title', 'LIKE', '%'.$request->q.'%')->orWhere('description', 'LIKE', '%'.$request->q.'%');
            }
        })->orderBy('id', 'DESC')->paginate();

        return view('admin.companies.sub_index', compact('companies', 'company'));
    }

    public function edit($company)
    {
        return view('admin.companies.edit', compact('company'));
    }


    public function update($request, $company)
    {
        $request->validate([
            'title'=>"required|max:190",
            'description'=>"nullable|max:10000",
        ]);
        try {
            DB::beginTransaction();

            $company->update([
                "title"=>$request->title,
                "description"=>$request->description,
            ]);
            if ($request->hasFile('image')) {
                $company->update(['image'=> uploadImage('companies', $request->image)]);
            }
            DB::commit();
            flash()->success('تم تحديث القسم بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.companies.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash()->success($e->getMessage(), 'عملية فاشلة');
            return back();
        }
    }

    public function destroy($company)
    {
        $company->delete();
        flash()->success('تم حذف القسم بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.companies.index');
    }
}