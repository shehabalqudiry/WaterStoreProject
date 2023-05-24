@extends('layouts.app', ['page_title' => 'الطلبات'])
@section('content')
    <div class="col-12">
        <div class="col-12 p-0 main-box">
            <div class="col-12 card-header">
                <div class="col-12 p-2 row justify-content-between">
                    <div class="">
                        <i class="la la-ball"></i> الطلبات
                    </div>
                    {{-- <div class="">
                        <a href="{{ route('admin.orders.create') }}">
                            <span class="btn btn-primary"><span class="la la-plus"></span> إضافة جديد</span>
                        </a>
                    </div> --}}
                </div>
            </div>

            <div class="col-12 py-2 px-2 row">
                <div class="col-12 col-lg-12 p-2">
                    <form method="GET" class="row">
                        <div class="col-12 col-md-6">
                            <input type="text" name="q" class="form-control d-inline" value="{{ request()->q }}"
                                placeholder="بحث عام ... ">
                        </div>
                        <div class="col-12 col-md-6">
                            <select name="ordersType" onchange="submit()" class="form-control d-inline">
                                <option {{ request()->ordersType || request()->ordersType == 'all' ? 'selected' : '' }} value="all">الكل
                                    ({{ \App\Models\Order::count() ?? 0 }})
                                </option>
                                <option {{ request()->ordersType == '0' ? 'selected' : '' }} value="0">
                                    جديد ({{ \App\Models\Order::where('status', 0)->count() ?? 0 }})
                                </option>


                                <option {{ request()->ordersType == '1' ? 'selected' : '' }} value="1">
                                    تم القبول وجاري التجهيز ({{ \App\Models\Order::where('status', 1)->count() ?? 0 }})
                                </option>

                                <option {{ request()->ordersType == '2' ? 'selected' : '' }} value="2">
                                    مرفوض ({{ \App\Models\Order::where('status', 2)->count() ?? 0 }})
                                </option>

                                <option {{ request()->ordersType == '3' ? 'selected' : '' }} value="3">
                                    تم التوصيل ({{ \App\Models\Order::where('status', 3)->count() ?? 0 }})
                                </option>

                                <option {{ request()->ordersType == '4' ? 'selected' : '' }} value="4">
                                    تم إلغاء من العميل ({{ \App\Models\Order::where('status', 4)->count() ?? 0 }})
                                </option>


                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 p-3" style="overflow:auto">
                <div class="col-12 p-0 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>رقم الطلب</th>
                                <th>حالة الطلب</th>
                                <th>تكلفة الطلب</th>
                                <th>المستخدم</th>
                                <th>المنتجات</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->number }}</td>
                                    <td>{{ $order->status_string }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->items()->count() }}</td>

                                    <td>
                                        @if ($order->status == 0)
                                            <form action="{{ route('admin.orders.update', $order->id) }}"
                                                class="btn btn-sm" method="post" id="updateAc{{ $order->id }}"
                                                onclick="document.getElementById('updateAc{{ $order->id }}').submit()">
                                                @method('PUT')
                                                @csrf
                                                <button href='#' class="btn btn-sm btn-outline-success">
                                                    <i class="la la-check" aria-hidden="true"></i> قبول
                                                </button>
                                                <input name="status" hidden value="1">
                                                {{-- </div> --}}
                                            </form>
                                            <form action="{{ route('admin.orders.update', $order->id) }}"
                                                class="btn btn-sm" method="post" id="updateRe{{ $order->id }}"
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
                                            <form action="{{ route('admin.orders.update', $order->id) }}"
                                                class="btn btn-sm" method="post" id="updateRe{{ $order->id }}"
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
                                        <a href="{{ route('admin.orders.show', $order->id) }}">
                                            <span class="btn btn-outline-primary btn-sm font-1 mx-1">
                                                <span class="la la-eye "></span> عرض
                                            </span>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{--  <div class="col-12 p-3">
                {{ $orders->appends(request()->query())->render() }}
            </div>  --}}
        </div>
    </div>
@endsection
