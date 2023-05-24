-
@extends('layouts.app', ['page_title' => 'إضافة اعلان'])
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">

            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.sliders.store') }}">
                @csrf
                <div class="col-12 col-lg-8 p-0 main-box mx-auto">
                    <div class="col-12 px-0 card-header">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> إضافة جديد
                        </div>
                    </div>
                    <div class="col-12 p-3 row">
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                اسم الاعلان
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="title" required maxlength="190" class="form-control"
                                    value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الرابط
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="url" required class="form-control"
                                    value="{{ old('url') }}">
                            </div>
                        </div>
                        <div class="col-12 p-2">
                            <div class="col-12">
                                الصورة
                            </div>
                            <div class="col-12 pt-3">
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                            </div>
                            <div class="col-12 pt-3">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 my-2">
                            <div class="col-12">
                                الوصف
                            </div>
                            <div class="col-12 pt-3">
                                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 my-2">
                            <div class="col-12">
                                اختار الحالة
                            </div>
                            <div class="col-12 pt-2">
                                <select class="form-control rounded-3" name="status" required>
                                    <option value="" selected>اختار الحالة</option>
                                    <option value="0" @if (old('status') == '0') selected @endif>
                                        مفعل</option>
                                    <option value="1" @if (old('status') == '1') selected @endif>
                                        غير مفعل</option>
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
