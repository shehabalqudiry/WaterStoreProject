@extends('layouts.app', ['page_title' => 'الفيديوهات'])
@section('content')
    <div class="col-12">
        <div class="col-12 p-0 main-box">
            <div class="col-12 card-header">
                <div class="col-12 p-2 row justify-content-between">
                    <div class="">
                        <i class="la la-youtube"></i> الفيديوهات
                    </div>
                    <div class="">
                        <a href="{{ route('admin.videos.create') }}">
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
                                <th>عنوان الفيديو</th>
                                <th>الموقع</th>
                                <th>الحالة</th>
                                <th>المستخدم</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $video)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $video->title }}</td>
                                    <td>{{ $video->location }}</td>
                                    <td>{{ $video->get_status() }}</td>
                                    <td>{{ $video->user->name ?? 'غير موجود' }}</td>

                                    <td>
                                        @if ($video->status == 0)
                                            <form action="{{ route('admin.videos.updateStatus', $video->id) }}"
                                                class="btn btn-sm" method="post" id="updateAc{{ $video->id }}"
                                                onclick="document.getElementById('updateAc{{ $video->id }}').submit()">
                                                {{-- @method('PUT') --}}
                                                @csrf
                                                <button href='#' class="btn btn-sm btn-outline-success">
                                                    <i class="la la-check" aria-hidden="true"></i> قبول
                                                </button>
                                                <input name="status" hidden value="1">
                                                {{-- </div> --}}
                                            </form>

                                            <form action="{{ route('admin.videos.updateStatus', $video->id) }}"
                                                class="btn btn-sm" method="post" id="updateRe{{ $video->id }}"
                                                onclick="document.getElementById('updateRe{{ $video->id }}').submit()">
                                                {{-- @method('PUT') --}}
                                                @csrf
                                                <button href='#' class="btn btn-sm btn-outline-danger">
                                                    <i class="la la-times" aria-hidden="true"></i> رفض
                                                </button>
                                                <input name="status" hidden value="2">
                                                {{-- </div> --}}
                                            </form>
                                        @endif
                                        @if ($video->status == 2)
                                            <form action="{{ route('admin.videos.updateStatus', $video->id) }}"
                                                class="btn btn-sm" method="post" id="updateAc{{ $video->id }}"
                                                onclick="document.getElementById('updateAc{{ $video->id }}').submit()">
                                                {{-- @method('PUT') --}}
                                                @csrf
                                                <button href='#' class="btn btn-sm btn-outline-success">
                                                    <i class="la la-check" aria-hidden="true"></i> تفعيل
                                                </button>
                                                <input name="status" hidden value="1">
                                                {{-- </div> --}}
                                            </form>
                                        @endif
                                        @if ($video->status == 1)
                                            <form action="{{ route('admin.videos.updateStatus', $video->id) }}"
                                                class="btn btn-sm" method="post" id="updateRe{{ $video->id }}"
                                                onclick="document.getElementById('updateRe{{ $video->id }}').submit()">
                                                {{-- @method('PUT') --}}
                                                @csrf
                                                <button href='#' class="btn btn-sm btn-outline-danger">
                                                    <i class="la la-times" aria-hidden="true"></i> ايقاف
                                                </button>
                                                <input name="status" hidden value="2">
                                                {{-- </div> --}}
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.videos.show', $video) }}">
                                            <span class="btn btn-outline-primary btn-sm font-1 mx-1">
                                                <span class="la la-search "></span> عرض
                                            </span>
                                        </a>
                                        <a href="{{ route('admin.videos.edit', $video) }}">
                                            <span class="btn btn-outline-success btn-sm font-1 mx-1">
                                                <span class="la la-wrench "></span> تحكم
                                            </span>
                                        </a>

                                        <form method="POST" action="{{ route('admin.videos.destroy', $video) }}"
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
                {{ $videos->appends(request()->query())->render() }}
            </div>
        </div>
    </div>
@endsection
