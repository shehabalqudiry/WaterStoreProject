@extends('layouts.app', ['page_title' => 'العروض'])
@section('content')
    <div class="col-12">
        <div class="col-12 p-0 main-box">
            <div class="col-12 card-header">
                <div class="col-12 p-2 row justify-content-between">
                    <div class="">
                        <i class="la la-youtube"></i> العروض
                    </div>
                    <div class="">
                        <a href="{{ route('admin.offers.create') }}">
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
                                <th>اسم العرض</th>
                                <th>السعر</th>
                                <th>صورة العرض</th>
                                <th>المنتج</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offers as $offer)
                                <tr>
                                    <td>{{ $offer->id }}</td>
                                    <td>{{ $offer->title }}</td>
                                    <td>
                                        {{ $offer->price_in_offer }}
                                    </td>
                                    <td><img src="{{ $offer->image }}" style="width:40px"></td>
                                    <td>{{ $offer->product->title ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('admin.offers.edit', $offer->id) }}">
                                            <span class="btn btn-outline-success btn-sm font-1 mx-1">
                                                <span class="la la-wrench "></span> تحكم
                                            </span>
                                        </a>

                                        <form method="POST" action="{{ route('admin.offers.destroy', $offer->id) }}"
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
                {{ $offers->appends(request()->query())->render() }}
            </div>  --}}
        </div>
    </div>
@endsection
