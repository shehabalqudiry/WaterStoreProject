@extends('layouts.app')
@section('content')
    <div class="col-12 py-5 rounded-2" style="text-align: center;background: #fff;margin-top: -5px;">
        <div class="col-12" style="display:flex;justify-content: center;">
            <img src="{{ $user->photo }}" style="width:130px;height: 130px;border-radius: 50%;">
        </div>
        <div class="col-12 p-2" style="overflow:auto;">
            ID : {{ $user->id }} <br>
            {{ $user->name }} <br>
            {{ $user->email }}<br>
            {{ $user->phone }}<br>
        </div>
    </div>
    <div class="col-12 py-0 px-3 row">
        <div class="col-12  pt-2" style="min-height: 80vh">
            <div class="col-12 col-lg-9 px-3 py-5 d-flex mx-auto justify-content-center align-items-center">
                <div class="col-12 p-0 row justify-content-center">
                    <div class="col-12 row p-0">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 px-2 mb-3">
                            <a href="#"
                                style="color:inherit;">
                                <div class="col-12 px-0 py-2 d-flex rounded-3 main-box-wedit" style="background: #ffffff;">
                                    <div class="p-2">
                                        <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center"
                                            style="background-image: linear-gradient(rgba(0,0,0,.04),rgba(0,0,0,.04))!important;height: 64px;border-radius: 50%;">
                                            <span class="la la-youtube font-5"></span>
                                        </div>
                                    </div>
                                    <div class="px-2 py-2">
                                        <h6 class="font-1">الفيديوهات</h6>
                                        <h6 class="font-3">0</h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
