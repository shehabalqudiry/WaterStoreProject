@extends('layouts.app')
@section('content')
    <div class="col-12 py-3">
        <div class="container">
            <div class="p-3 main-box mx-auto" id="printJS-form" style="width:100%;max-width: 100%;">
                <a href="{{ route('admin.printOrder', $order->number) }}" class="btn btn-block btn-success">طباعة</a>
                <div class="d-flex align-items-center justify-content-center py-4">
                    <div class="col-12 d-flex justify-content-center align-items-center mx-auto " style="width:100%">
                        <div class="col-12 p-0 text-center">
                            <div class="col-12 font-3 text-center py-2">
                                <h3>رقم الطلب</h3>
                                #{{ $order->number }}
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-12 p-0">
                    <table class="table table-bordered table-striped rounded table-hover">
                        <tbody>

                            <tr>
                                <td>تكلفة الطلب</td>
                                <td>
                                    {{ $order->total }}
                                </td>
                            </tr>
                            <tr>
                                <td>حالة الطلب</td>
                                <td>
                                    {{ $order->status_string }}
                                </td>
                            </tr>
                            <tr>
                                <td>المستخدم</td>
                                <td>
                                    {{ $order->user->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>العنوان</td>
                                <td>
                                    {{ $order->address->country }} -
                                    {{ $order->address->city }} -
                                    {{ $order->address->region }} -
                                    {{ $order->address->street }}
                                </td>
                            </tr>
                            <tr>
                                <td>المنتجات</td>
                                <td>
                                    {{ $order->items()->count() }}
                                </td>
                            </tr>

                            <tr>
                                <td>تحكم</td>
                                <td>
                                    @if ($order->status == 0)
                                        <form action="{{ route('admin.orders.update', $order->id) }}" class="btn btn-sm"
                                            method="post" id="updateAc{{ $order->id }}"
                                            onclick="document.getElementById('updateAc{{ $order->id }}').submit()">
                                            @method('PUT')
                                            @csrf
                                            <button href='#' class="btn btn-sm btn-outline-success">
                                                <i class="la la-check" aria-hidden="true"></i> قبول
                                            </button>
                                            <input name="status" hidden value="1">
                                            {{-- </div> --}}
                                        </form>
                                        <form action="{{ route('admin.orders.update', $order->id) }}" class="btn btn-sm"
                                            method="post" id="updateRe{{ $order->id }}"
                                            onclick="document.getElementById('updateRe{{ $order->id }}').submit()">
                                            @method('PUT')
                                            @csrf
                                            <button href='#' class="btn btn-sm btn-outline-danger">
                                                <i class="la la-times" aria-hidden="true"></i> رفض
                                            </button>
                                            <input name="status" hidden value="2">
                                            {{-- </div> --}}
                                        </form>
                                    @endif

                                    @if ($order->status == 1)
                                        <form action="{{ route('admin.orders.update', $order->id) }}" class="btn btn-sm"
                                            method="post" id="updateRe{{ $order->id }}"
                                            onclick="document.getElementById('updateRe{{ $order->id }}').submit()">
                                            @method('PUT')
                                            @csrf
                                            <button href='#' class="btn btn-sm btn-outline-success">
                                                <i class="la la-times" aria-hidden="true"></i> تم التوصيل ؟
                                            </button>
                                            <input name="status" hidden value="3">
                                            {{-- </div> --}}
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.orders.destroy', $order) }}"
                                        class="d-inline-block">@csrf @method('DELETE')
                                        <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                            onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
                                            <span class="la la-trash "></span> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>

                <div class="row d-flex justify-content-center my-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4 class="card-title text-success">المنتجات ({{ $order->items->count() }})</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-12 p-3" style="overflow:auto">
                                    <div class="col-12 p-0 table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>صورة المنتج</th>
                                                    <th>اسم المنتج</th>
                                                    <th>سعر المنتج</th>
                                                    <th>الشركة</th>
                                                    <th>شخصي/مسجد</th>
                                                    <th>الكمية</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($order->items as $product)
                                                    <tr>
                                                        <td>{{ $product->product->id }}</td>
                                                        <td><img src="{{ $product->product->main_image() }}"
                                                                style="width:40px"></td>
                                                        <td>{{ $product->product->title }}</td>
                                                        <td>{{ $product->product->price }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.companies.index', ['id' => $product->product->company_id]) }}"
                                                                style="color:#2381c6">{{ $product->product->company->title ?? '' }}</a>
                                                        </td>
                                                        <td>
                                                            {{ $product->mosque_name == null ? 'شخصي' : $product->mosque_name }}
                                                            @if ($product->mosque_name != null and ($product->mosque_lat or $product->mosque_long))
                                                            <a href="https://www.google.com/maps/{{ '@' .$product->mosque_lat.','.$product->mosque_long }},20z" target="_blank">الموقع علي الخريطة</a>
                                                            @endif
                                                        </td>
                                                        <td>{{ $product->quantity }}</td>

                                                    </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- Card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.print_btn').on('click', function() {
            $('.print_btn').window.print();
        });
    </script>
@endsection
