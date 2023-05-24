@extends('layouts.app', ['page_title' => 'المستخدمين'])
@section('content')
    <div class="col-12">
        <div class="col-12 p-0 main-box">
            <div class="col-12 card-header">
                <div class="col-12 p-2 row justify-content-between">
                    <div class="">
                        <i class="la la-users"></i> المستخدمين
                    </div>
                    <div class="">
                        <a href="{{ route('admin.users.create') }}">
                            <span class="btn btn-primary"><span class="la la-plus"></span> إضافة جديد</span>
                        </a>
                        <a href="#" data-toggle="modal" data-target="#sendNotifyAll">
                            <span class="btn btn-primary"><span class="la la-bell"></span> إرسـال إشعار للكل</span>
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
                <div class="col-12 p-0">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الصورة</th>
                                <th>الحالة</th>
                                <th>الاسم</th>
                                <th>الهاتف</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        @if ($user->best == 1)
                                            <span class="la la-bell"></span>
                                        @endif {{ $loop->iteration }}
                                    </td>
                                    <td><img src="{{ $user->photo }}" class="rounded-circle" width="60" height="60"
                                            alt=""></td>
                                    <td>
                                        <span class="badge badge-{{ $user->status == 1 ? 'success' : 'danger' }}">
                                            {{ $user->status == 1 ? 'نشط' : 'موقوف مؤقتاً' }}</span>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone }}</td>

                                    <td>
                                        <a href="{{ route('admin.users.show', $user) }}">
                                            <span class="btn  btn-outline-primary btn-sm font-1 mx-1">
                                                <span class="la la-search "></span> عرض
                                            </span>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user) }}">
                                            <span class="btn btn-outline-success btn-sm font-1 mx-1">
                                                <span class="la la-wrench "></span> تحكم
                                            </span>
                                        </a>

                                        <a data-toggle="modal" data-target="#sendNotify_{{ $user->id }}"
                                            href="#">
                                            <span class="btn btn-outline-info btn-sm font-1 mx-1">
                                                <span class="la la-bell "></span> إرسال اشعار
                                            </span>
                                        </a>

                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                            class="d-inline-block">@csrf @method('DELETE')
                                            <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                                onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
                                                <span class="la la-trash "></span> حذف
                                            </button>
                                        </form>

                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="sendNotify_{{ $user->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="sendNotify_{{ $user->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="sendNotify_{{ $user->id }}Label">إرســال
                                                    إلـي {{ $user->name }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.users.sendNotify') }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="users" value="{{ $user->id }}">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="title"
                                                            placeholder="عنوان الاشعار">
                                                    </div>

                                                    <div class="form-group">
                                                        <textarea rows="6" cols="8" class="form-control" name="body" placeholder="محتوى الاشعار"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">إغلاق</button>
                                                    <button type="submit" class="btn btn-primary">إرســـال</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{--  <div class="col-12 p-3">
                {{ $users->appends(request()->query())->render() }}
            </div>  --}}

        </div>
    </div>

    <div class="modal fade" id="sendNotifyAll" tabindex="-1" role="dialog" aria-labelledby="sendNotifyAllLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.users.sendNotify') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="users" value="All">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="عنوان الاشعار">
                        </div>

                        <div class="form-group">
                            <textarea rows="6" cols="8" class="form-control" name="body" placeholder="محتوى الاشعار"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إرســـال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
