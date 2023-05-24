@extends('layouts.app', ['page_title' => 'تعديل منتج'])
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">

            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.products.update', $product->id) }}">
                @csrf
                @method('PUT')
                <div class="col-12 col-lg-8 p-0 main-box mx-auto">
                    <div class="col-12 px-0 card-header">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> تعديل
                        </div>
                    </div>
                    <div class="col-12 p-3 row">
                        <div class="col-12 col-lg-6 my-2">
                            <div class="col-12">
                                اختار الشركة <a href="{{ route('admin.companies.create') }}"
                                    class="btn btn-primary btn-sm"><span class="la la-plus"></span></a>
                            </div>
                            <div class="col-12 pt-2">
                                <select class="form-control rounded-3" name="company_id" required>
                                    <option value="" selected>اختار الشركة</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"
                                            @if ($product->company_id == $company->id) selected @endif>
                                            {{ $company->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 my-2">
                            <div class="col-12">
                                اختار النوع
                            </div>
                            <div class="col-12 pt-2">
                                <select class="form-control rounded-3" name="type" required>
                                    <option value="" selected>اختار النوع</option>
                                    <option value="0" @if ($product->type == '0') selected @endif>
                                        المنزل</option>
                                    <option value="1" @if ($product->type == '1') selected @endif>
                                        المسجد</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                اسم المنتج
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="title" required maxlength="190" class="form-control"
                                    value="{{ $product->title }}">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                السعر
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="price" required class="form-control"
                                    value="{{ $product->price }}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                السعر بعد الخصم
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="discount_price" required class="form-control"
                                    value="{{ $product->discount_price }}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الحد الادنى
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="min" class="form-control" value="{{ $product->min }}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الحد الاقصى
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="max" class="form-control" value="{{ $product->max }}">
                            </div>
                        </div>
                        <div class="col-12 p-2">
                            <div class="col-12">
                                الصورة
                                <img src="{{ $product->main_image() }}" alt="">
                            </div>
                            <div class="col-12 pt-3">
                                <input type="file" name="main_image" class="form-control" accept="image/*">
                            </div>
                            <div class="col-12 pt-3">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 my-2">
                            <div class="col-12">
                                الوصف
                            </div>
                            <div class="col-12 pt-3">
                                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 my-2">
                            <div class="col-12">
                                اختار الحالة
                            </div>
                            <div class="col-12 pt-2">
                                <select class="form-control rounded-3" name="status" required>
                                    <option value="" selected>اختار الحالة</option>
                                    <option value="0" @if ($product->status == '0') selected @endif>
                                        مفعل</option>
                                    <option value="1" @if ($product->status == '1') selected @endif>
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
