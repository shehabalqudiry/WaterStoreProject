@extends('layouts.app', ['page_title' => 'غرف الدردشة'])
@section('content')
    <div class="col-12">
        <div class="col-12 p-0 main-box">
            <div class="col-12 card-header">
                <div class="col-12 p-2 row justify-content-between">
                    <div class="">
                        <i class="la la-ball"></i> غرف الدردشة
                    </div>
                    <div class="">
                        <a href="{{ route('admin.chats.create') }}">
                            <span class="btn btn-primary"><span class="la la-plus"></span> إضافة جديد</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 py-2 px-2 row">
                <div class="col-12 col-lg-12 p-2">
                    <form method="GET" class="row">
                        <div class="col-12 col-md-6">
                            <input type="text" name="q" class="form-control d-inline" value="{{ request()->q }}"
                                placeholder="بحث ... ">
                        </div>
                        {{-- <div class="col-12 col-md-6">
                            <select name="chatsType" onchange="submit()" class="form-control d-inline">
                                <option {{ request()->chatsType == 'all' ? 'selected' : '' }} value="all">الكل
                                </option>
                                <option {{ request()->chatsType == 'main' ? 'selected' : '' }} value="main">غرف الدردشة
                                    الرئيسية</option>
                                <option {{ request()->chatsType == 'sub' ? 'selected' : '' }} value="sub">غرف الدردشة
                                    الفرعية</option>
                            </select>
                        </div> --}}
                    </form>
                </div>
            </div>
            <div class="col-12 p-3" style="overflow:auto">
                <div class="col-12 p-0 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>المسئول</th>
                                <th>عدد المسئولين</th>
                                <th>عدد المستخدمين</th>
                                <th>الحالة</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chats as $chat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $chat->name }}</td>
                                    <td>{{ $chat->owner->name ?? '' }}</td>
                                    <td>{{ $chat->admins->count() }}</td>
                                    <td>{{ $chat->users->count() }}</td>
                                    <td class="@if($chat->status == 1) text-success @elseif($chat->status == 2) text-danger @else text-warning @endif">{{ $chat->get_status() }}</td>

                                    <td>
                                        @if ($chat->status == 0)
                                            <form action="{{ route('admin.chats.updateStatus', $chat->id) }}"
                                                class="btn btn-sm" method="post" id="updateAc{{ $chat->id }}"
                                                onclick="document.getElementById('updateAc{{ $chat->id }}').submit()">
                                                {{-- @method('PUT') --}}
                                                @csrf
                                                <button href='#' class="btn btn-sm btn-outline-success">
                                                    <i class="la la-check" aria-hidden="true"></i> قبول
                                                </button>
                                                <input name="status" hidden value="1">
                                                {{-- </div> --}}
                                            </form>
                                            <form action="{{ route('admin.chats.updateStatus', $chat->id) }}"
                                                class="btn btn-sm" method="post" id="updateRe{{ $chat->id }}"
                                                onclick="document.getElementById('updateRe{{ $chat->id }}').submit()">
                                                {{-- @method('PUT') --}}
                                                @csrf
                                                <button href='#' class="btn btn-sm btn-outline-danger">
                                                    <i class="la la-times" aria-hidden="true"></i> رفض
                                                </button>
                                                <input name="status" hidden value="2">
                                                {{-- </div> --}}
                                            </form>
                                        @endif
                                        @if ($chat->status == 2)
                                            <form action="{{ route('admin.chats.updateStatus', $chat->id) }}"
                                                class="btn btn-sm" method="post" id="updateAc{{ $chat->id }}"
                                                onclick="document.getElementById('updateAc{{ $chat->id }}').submit()">
                                                {{-- @method('PUT') --}}
                                                @csrf
                                                <button href='#' class="btn btn-sm btn-outline-success">
                                                    <i class="la la-check" aria-hidden="true"></i>تفعيل
                                                </button>
                                                <input name="status" hidden value="1">
                                                {{-- </div> --}}
                                            </form>
                                        @endif
                                        @if ($chat->status == 1)
                                            <form action="{{ route('admin.chats.updateStatus', $chat->id) }}"
                                                class="btn btn-sm" method="post" id="updateRe{{ $chat->id }}"
                                                onclick="document.getElementById('updateRe{{ $chat->id }}').submit()">
                                                {{-- @method('PUT') --}}
                                                @csrf
                                                <button href='#' class="btn btn-sm btn-outline-danger">
                                                    <i class="la la-times" aria-hidden="true"></i> إيقاف
                                                </button>
                                                <input name="status" hidden value="2">
                                                {{-- </div> --}}
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.chats.edit', $chat) }}">
                                            <span class="btn btn-outline-success btn-sm font-1 mx-1">
                                                <span class="la la-wrench "></span> تحكم
                                            </span>
                                        </a>

                                        <form method="POST" action="{{ route('admin.chats.destroy', $chat) }}"
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
                {{ $chats->appends(request()->query())->render() }}
            </div>
        </div>
    </div>
@endsection
