@extends('layouts.app', ['page_title' => 'كوبونات الخصم'])
@section('content')
    <div class="col-12">
        <div class="col-12 p-0 main-box">
            <div class="col-12 card-header">
                <div class="col-12 p-2 row justify-content-between">
                    <div class="">
                        <i class="la la-youtube"></i> كوبونات الخصم
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#createCoupon">
                            <span class="btn btn-primary"><span class="la la-plus"></span> إضافة جديد</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-12 p-3" style="overflow:auto">
                <div class="col-12 p-0 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الكود</th>
                                <th>العدد المتاح</th>
                                <th>القيمة</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ $coupon->number }}</td>
                                    <td>{{ $coupon->value }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal"
                                            data-target="#updateCoupons{{ $coupon->id }}">
                                            <span class="btn btn-outline-success btn-sm font-1 mx-1">
                                                <span class="la la-wrench "></span> تحكم
                                            </span>
                                        </a>

                                        <form method="POST" action="{{ route('admin.coupons.destroy', $coupon->id) }}"
                                            class="d-inline-block">@csrf @method('DELETE')
                                            <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                                onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
                                                <span class="la la-trash "></span> حذف
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                <div class="modal fade" id="updateCoupons{{ $coupon->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalUpdatePro" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title"><i class="la la-frown-o"></i> اضافة</h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body text-center">
                                                    <div class="row form-group">
                                                        <label>الكود</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $coupon->coupon_code }}" name="code" required>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label>القيمة</label>
                                                        <input type="number" class="form-control" name="value" required
                                                            value="{{ $coupon->value }}">
                                                    </div>

                                                    <div class="row form-group">
                                                        <label>العدد المتاح</label>
                                                        <input type="number" class="form-control" name="number" required
                                                            value="{{ $coupon->number }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">اغلاق</button>
                                                    <button type="submit" class="btn btn-success">اضافة</button>
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
                {{ $coupons->appends(request()->query())->render() }}
            </div>  --}}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createCoupon" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"><i class="la la-frown-o"></i> اضافة</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.coupons.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-center">
                        <div class="row form-group">
                            <label>الكود</label>
                            <input type="text" class="form-control" name="code" required>
                        </div>
                        <div class="row form-group">
                            <label>القيمة</label>
                            <input type="number" class="form-control" name="value" required>
                        </div>

                        <div class="row form-group">
                            <label>العدد المتاح</label>
                            <input type="number" class="form-control" name="number">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-success">اضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
