@extends('layouts.app', ['page_title' => 'المساجد'])
@section('content')
    <div class="col-12">
        <div class="col-12 p-0 main-box">
            <div class="col-12 card-header">
                <div class="col-12 p-2 row justify-content-between">
                    <div class="">
                        <i class="la la-youtube"></i> المساجد
                    </div>
                    <div class="">
                        <a href="{{ route('admin.mosques.create') }}">
                            <span class="btn btn-primary"><span class="la la-plus"></span> إضافة جديد</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 p-3" style="overflow:auto">
                <div class="col-12 p-0 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>المسجد</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mosques as $mosque)
                                <tr>
                                    <td>{{ $mosque->id }}</td>
                                    <td>{{ $mosque->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.mosques.edit', $mosque->id) }}">
                                            <span class="btn btn-outline-success btn-sm font-1 mx-1">
                                                <span class="la la-wrench "></span> تحكم
                                            </span>
                                        </a>

                                        <form method="POST" action="{{ route('admin.mosques.destroy', $mosque->id) }}"
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
            {{--  <div class="col-12 p-3">
                {{ $mosques->appends(request()->query())->render() }}
            </div>  --}}
        </div>
    </div>
@endsection
