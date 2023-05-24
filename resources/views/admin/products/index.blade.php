@extends('layouts.app', ['page_title' => 'منتجات المتجر'])
@section('content')
    <div class="col-12">
        <div class="col-12 p-0 main-box">
            <div class="col-12 card-header">
                <div class="col-12 p-2 row justify-content-between">
                    <div class="">
                        <i class="la la-youtube"></i> منتجات المتجر
                    </div>
                    <div class="">
                        <a href="{{ route('admin.products.create') }}">
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
                                <th>اسم المنتج</th>
                                <th>الشركة</th>
                                <th>صورة المنتج</th>
                                <th>الحالة</th>
                                <th>السعر</th>
                                <th>السعر بعد الخصم</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>
                                        <a href="{{ route('admin.companies.index', ['id' => $product->company_id]) }}"
                                            style="color:#2381c6">{{ $product->company->title ?? '' }}</a>
                                    </td>
                                    {{-- <td>{{$product->slug}}</td> --}}
                                    <td><img src="{{ $product->main_image() }}" style="width:40px"></td>
                                    <td>
                                        <span class="badge badge-{{ $product->status == 0 ? 'success' : 'danger' }}">
                                            {{ $product->status == 0 ? 'نشط' : 'مخفى' }}</span>
                                    </td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->discount_price ?? "لا يوجد" }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', $product->id) }}">
                                            <span class="btn btn-outline-success btn-sm font-1 mx-1">
                                                <span class="la la-wrench "></span> تحكم
                                            </span>
                                        </a>

                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
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
                {{ $products->appends(request()->query())->render() }}
            </div>  --}}
        </div>
    </div>
@endsection
