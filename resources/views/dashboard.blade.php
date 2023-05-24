@extends('layouts.app')
@section('content')
@section('pageTitle', 'الرئيسية')

<div class="row">
    <div class="col-md-3">
        <div class="card card-stats card-warning">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la-users"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        <div class="numbers">
                            <p class="card-category">الوحدات</p>
                            <h4 class="card-title"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
