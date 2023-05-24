@extends('layouts.app')
@section('styles')
    <style>
        .main-header,
        .sidebar,
        .footer {
            display: none;
        }

        .nav_open .main-panel {
            position: relative;
            width: 100% !important;
            min-height: 100vh !important;
            height: 100vh !important;
            float: left;
            background: #f2f3f8;
        }

        .nav_open .main-panel .content {
            padding: 30px 15px;
            /* min-height: calc(100% - 123px); */
            margin-top: 10px;
        }

        .footer {
            display: none;
            border-top: 1px solid #eee;
            padding: 15px;
            background: #ffffff;
        }

        .footer .container-fluid {
            display: none;
            align-items: center;
        }
    </style>
@endsection
@section('content')
    <div class="col-12 py-3">
        <div class="container">
            <div class="p-3 main-box mx-auto" id="printJS-form" style="width:100%;max-width: 100%;">
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
                                                    <th>اسم المنتج</th>
                                                    <th>سعر المنتج</th>
                                                    <th>الكمية</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($order->items as $product)
                                                    <tr>
                                                        <td>{{ $product->product->id }}</td>
                                                        <td>{{ $product->product->title }}</td>
                                                        <td>{{ $product->product->price }}</td>
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(window).on('load', function() {
            window.print();
        });
    </script>
@endsection
