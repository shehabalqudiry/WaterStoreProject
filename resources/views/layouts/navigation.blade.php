<div class="main-header">
    <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-none">@csrf</form>

    <nav class="navbar navbar-header navbar-expand-lg">
        <i class="la la-align-justify sidenav-toggler" style="font-size: 25px"></i>
        {{-- <i class="la la-align-justify sidenav-toggler" style="font-size: 25px"></i> --}}
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <span class="la la-bell font-4 mx-2 d-inline-block"
                            style="color: #333;transform: rotate(15deg)"></span>
                        <span
                            style="position: absolute;min-width: 25px;min-height: 25px;
                    @if ($unreadNotifications != 0) display: inline-block;
                    @else
                    display: none; @endif
                    right: 0px;top: 0px;border-radius: 20px;background: #c00;color:#fff;font-size: 14px;"
                            id="dropdown-notifications-icon">{{ $unreadNotifications ?? 0 }}</span>

                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <div class="col-12 notifications-container" style="height:406px;overflow: auto;">
                            <x-notifications :notifications="$notifications" />
                        </div>
                        <div class="col-12 d-flex border-top">
                            <a href="{{ route('admin.notifications.index') }}" class="d-block py-2 px-3 ">
                                <div class="col-12 align-items-center">
                                    <span class="la la-bell"></span> عرض كل الإشعارات
                                </div>
                            </a>
                        </div>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                        aria-expanded="false"><span>{{ auth()->user()->name ?? '' }}</span> </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <div class="user-box">
                                <div class="u-text">
                                    <h4>{{ auth()->user()->name ?? '' }}</h4>
                                </div>
                            </div>
                        </li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i class="fa fa-pen"></i>
                            الملف الشخصي</a>
                        <a class="dropdown-item" href="#"
                            onclick="document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>
                            تسجيل خروج</a>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</div>
