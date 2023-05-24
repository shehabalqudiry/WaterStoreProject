@extends('layouts.app', ['page_title' => 'تعديل غرفة دردشة'])
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">

            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.chats.update', $chat) }}">
                @method('PUT')
                @csrf
                <div class="col-12 col-lg-8 p-0 main-box mx-auto">
                    <div class="col-12 px-0 card-header">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> تعديل
                        </div>
                    </div>
                    <div class="col-12 p-3 row">
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                اسم غرفة دردشة
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="name" required maxlength="190" class="form-control"
                                    value="{{ $chat->name }}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                المسئول
                            </div>
                            <div class="col-12 pt-3">
                                <select type="text" name="owner" required class="form-control">
                                    @foreach (App\Models\User::latest()->get() as $user)
                                        <option {{ $chat->owner_id == $user->id ? 'selected' : '' }}
                                            value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 p-2">
                            <div class="col-12">
                                الصورة
                            </div>
                            <div class="col-12 pt-3">
                                <input type="file" name="photo" required class="form-control" accept="image/*">
                            </div>
                            <div class="col-12 pt-3">
                                <img src="{{ $chat->photo }}" width="120" class="rounded-circle" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الحالة
                            </div>
                            <div class="col-12 pt-3">
                                <select type="text" name="status" required class="form-control">
                                    <option {{ $chat->status == 0 ? 'selected' : '' }} value="0">قيد المراجعه</option>
                                    <option {{ $chat->status == 1 ? 'selected' : '' }} value="1">تفعيل</option>
                                    <option {{ $chat->status == 2 ? 'selected' : '' }} value="2">ايقاف</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12 p-3">
                            <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
