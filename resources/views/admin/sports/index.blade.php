@extends('layouts.app', ['page_title' => 'انواع الرياضات'])
@section('content')
    <div class="col-12">
        <div class="col-12 p-0 main-box">
            <div class="col-12 card-header">
                <div class="col-12 p-2 row justify-content-between">
                    <div class="">
                        <i class="la la-ball"></i> انواع الرياضات
                    </div>
                    <div class="">
                        <a href="{{ route('admin.sports.create') }}">
                            <span class="btn btn-primary"><span class="la la-plus"></span> إضافة جديد</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 py-2 px-2 row">
                <div class="col-12 col-lg-4 p-2">
                    <form method="GET">
                        <input type="text" name="q" class="form-control" value="{{ request()->q }}"
                            placeholder="بحث ... ">
                    </form>
                </div>
            </div>
            <div class="col-12 p-3" style="overflow:auto">
                <div class="col-12 p-0 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الصورة</th>
                                <th>الاسم</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sports as $sport)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ $sport->photo }}" class="rounded-2" width="150" height="100"
                                            alt=""></td>
                                    <td>{{ $sport->title }}</td>

                                    <td>
                                        <a href="{{ route('admin.sports.edit', $sport) }}">
                                            <span class="btn btn-outline-success btn-sm font-1 mx-1">
                                                <span class="la la-wrench "></span> تحكم
                                            </span>
                                        </a>

                                        <form method="POST" action="{{ route('admin.sports.destroy', $sport) }}"
                                            class="d-inline-block">@csrf @method('DELETE')
                                            <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                                onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
                                                <span class="la la-trash "></span> حذف
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 p-3">
                {{ $sports->appends(request()->query())->render() }}
            </div>
        </div>
    </div>
@endsection
