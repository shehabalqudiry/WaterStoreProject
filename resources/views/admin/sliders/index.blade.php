@extends('layouts.app', ['page_title' => 'سلايدير'])
@section('content')
    <div class="col-12">
        <div class="col-12 p-0 main-box">
            <div class="col-12 card-header">
                <div class="col-12 p-2 row justify-content-between">
                    <div class="">
                        <i class="la la-youtube"></i> سلايدير
                    </div>
                    <div class="">
                        <a href="{{ route('admin.sliders.create') }}">
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
                                <th>اسم الاعلان</th>
                                <th>الرابط</th>
                                <th>صورة الاعلان</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>
                                        <a href="{{ $slider->url }}" style="color:#2381c6" target="_blank">{{ $slider->url }}</a>
                                    </td>
                                    {{-- <td>{{$slider->slug}}</td> --}}
                                    <td><img src="{{ $slider->image }}" style="width:40px"></td>
                                    <td>
                                        <a href="{{ route('admin.sliders.edit', $slider->id) }}">
                                            <span class="btn btn-outline-success btn-sm font-1 mx-1">
                                                <span class="la la-wrench "></span> تحكم
                                            </span>
                                        </a>

                                        <form method="POST" action="{{ route('admin.sliders.destroy', $slider->id) }}"
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
                {{ $sliders->appends(request()->query())->render() }}
            </div>  --}}
        </div>
    </div>
@endsection
