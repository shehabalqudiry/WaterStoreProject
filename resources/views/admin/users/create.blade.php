@extends('layouts.app', ['page_title' => 'إضافة مستخدم جديد'])
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">


            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.users.store') }}">
                @csrf
                <div class="col-12 p-0 main-box">
                    <div class="col-12 px-0 card-header">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> إضافة مستخدم جديد
                        </div>
                    </div>
                    <div class="col-12 p-3">
                        <div class="row text-center my-3">
                            <livewire:upload-photo-with-preview />
                        </div>
                        <div class="row my-3">
                            <div class="col-12 col-md-6 col-lg-4 p-2">
                                <div class="col-12">
                                    الاسم
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="text" name="name" required minlength="3"
                                        class="form-control" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 p-2">
                                <div class="col-12">
                                    كلمة المرور
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="password" name="password" class="form-control" minlength="8"
                                        placeholder="********" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 p-2">
                                <div class="col-12">
                                    الهاتف
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="text" name="phone" required class="form-control"
                                        value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12 col-md-6 p-2">
                                <div class="col-12">
                                    البريد الالكتروني
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 p-2">
                                <div class="col-12">
                                    نوع الحساب
                                </div>
                                <div class="col-12 pt-3">
                                    <select class="form-control" name="type" required>
                                        <option @if (old('type') == '0') selected @endif value="0">شخصي
                                        </option>
                                        <option @if (old('type') == '1') selected @endif value="1">شركة
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 p-2">
                                <div class="col-12">
                                    نبذة
                                </div>
                                <div class="col-12 pt-3">
                                    <textarea name="bio" maxlength="5000" class="form-control" style="min-height:150px">{{ old('bio') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 my-2">
                                <div class="col-12">
                                    اختار الحالة
                                </div>
                                <div class="col-12 pt-2">
                                    <select class="form-control rounded-3" name="status" required>
                                        <option value="" selected>اختار الحالة</option>
                                        <option value="1" @if (old('status', $user->status ?? 1) == '1') selected @endif>
                                            نشط</option>
                                        <option value="0" @if (old('status', $user->status ?? 1) == '0') selected @endif>
                                            موقوف مؤقتاً</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                </div>

                <div class="col-12 p-3">
                    <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection
