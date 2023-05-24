<!DOCTYPE html>
<html lang="ar" class="nav_open">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets') }}/css/main.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/ready.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.css" />
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">

    @include('seo.index')
    @php
        $page_title = 'الرئيسية';
    @endphp
    @livewireStyles
    @yield('styles')
    @if (auth()->check())
        @php
            if (session('seen_notifications') == null) {
                session(['seen_notifications' => 0]);
            }
            $notifications = auth()
                ->user()
                ->notifications()
                ->orderBy('created_at', 'DESC')
                ->limit(50)
                ->get();
            $unreadNotifications = auth()
                ->user()
                ->unreadNotifications()
                ->count();
        @endphp
    @endif
    <style>
        .main-box {
            background: #fff;
        }

        .font-5 {
            font-size: 2.5rem;
        }

        .main-box {
            background: #fff;
            border-radius: 5px;
        }

        .main-box-wedit {
            box-shadow: 0 8px 16px 0 rgb(10 14 29 / 2%), 0 8px 64px 0 rgb(119 119 119 / 8%);
        }

        .dt-buttons {
            text-align: center;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .dt-buttons button {

            padding: 5px 20px;
            margin: 10px 5px;
            border-radius: 5px !important;
            background: rgb(34, 121, 102);
        }

        @media screen and (max-width: 991px) .navbar-header .navbar-nav {
            flex-direction: row;
        }
    </style>
</head>

<body>
    @if (flash()->message)
        <div style="position: absolute;z-index: 4444444444444;left: 35px;top: 80px;max-width: calc(100% - 70px);padding: 16px 22px;border-radius: 7px;overflow: hidden;width: 273px;border-right: 8px solid #374b52;background: #2196f3;color: #fff;cursor: pointer;"
            onclick="$(this).slideUp();">
            <span class="fas fa-info-circle"></span> {{ flash()->message }}
        </div>
    @endif
    @if ($errors->any())
        <div class="col-12 justify-content-end d-flex">
            <div class="col-12" style="position: absolute;top: 80px;left: 10px;">
                {!! implode(
                    '',
                    $errors->all(
                        '<div class="alert-click-hide alert alert-danger alert alert-danger col-9 col-xl-3 rounded-0 mb-1" style="position: fixed!important;z-index: 11;opacity:.9;left:25px;cursor:pointer;" onclick="$(this).fadeOut();">:message</div>',
                    ),
                ) !!}
            </div>
        </div>
    @endif
    <div class="wrapper" id="app">
        @include('layouts.navigation')
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">@yield('pageTitle')</h4>
                    @yield('content')
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>


    {{-- <script src="https://cdn.agora.io/sdk/release/AgoraRTCSDK-3.3.1.js"></script> --}}
    <script src="{{ asset('assets') }}/js/core/jquery.3.2.1.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/chartist/chartist.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/chart-circle/circles.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ asset('assets') }}/js/ready.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.js">
    </script>

    {{-- <script src="{{ asset('assets') }}/js/demo.js"></script> --}}
    <script src="https://cdn.rtlcss.com/bootstrap/v4.0.0/js/bootstrap.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    @livewireScripts
    <script>
        $('.table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/a5734b29083/i18n/Arabic.json',
            },

        });
        var $selectt = $('html');

        $(window).ready(function() {
            if (window.innerWidth <= 720)
                $selectt.removeClass('nav_open');
            else
                $selectt.addClass('nav_open');
        });
        $(window).resize(function() {
            if (window.innerWidth <= 720)
                $selectt.removeClass('nav_open');
            else
                $selectt.addClass('nav_open');
        });
    </script>
    @yield('scripts')
    {{-- @stack('scripts') --}}
</body>

</html>
