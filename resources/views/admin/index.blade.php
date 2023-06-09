@extends('layouts.app')
@section('content')
{{-- @dd(auth()->user()->notifications()->delete()) --}}
<div class="col-12 py-2 px-3 row">

    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 px-2 mb-3">
        <div class="col-12 px-0 py-1 d-flex main-box-wedit" >
            <div style="width: 65px;" class="p-2">
                <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center" style="background: #0194fe;color: #fff;border-radius: 50%;width: 55px;height:55px">
                    <span class="la la-users font-4" ></span>
                </div>
            </div>
            <div style="width: calc(100% - 80px)" class="px-2 py-2">
                <h6 class="font-1">المستخدمين</h6>
                <h6 class="font-3">{{\App\Models\User::count()}}</h6>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 px-2 mb-3">
        <div class="col-12 px-0 py-1 d-flex main-box-wedit" >
            <div style="width: 65px;" class="p-2">
                <div class="col-12 px-0 text-center d-flex align-items-center justify-content-center" style="background: #0194fe;color: #fff; border-radius: 50%;width: 55px;height:55px">
                    <span class="la la-bell font-4" ></span>
                </div>
            </div>
            <div style="width: calc(100% - 80px)" class="px-2 py-2">
                <h6 class="font-1">الإشعارات</h6>
                <h6 class="font-3">{{auth()->user()->unreadNotifications->count()}}</h6>
            </div>
        </div>
    </div>

    <div class="col-12 px-2 pb-2">
        <div style="height: 4px ;background: #0194fe;border-radius: 7px;transition: width .5s ease-in-out;width: 0%;" id="home-dashboard-divider"></div>
    </div>
    <livewire:dashboard-statistics />
</div>
@endsection
@push('scripts')
<script type="text/javascript">
	$('#home-dashboard-divider').css('width','40%');
</script>
@endpush
