<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" >

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $settings->website_name }} - {{ $settings->website_bio }}</title>

    @if (LaravelLocalization::getCurrentLocale() == 'ar')
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.0.0/css/bootstrap.min.css">
    @else
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/bootstrap.min.css">
    @endif

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/fonts/line-icons.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/slicknav.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/color-switcher.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/nivo-lightbox.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/animate.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/owl.carousel.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/main.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/responsive.css">
</head>

<body>
    <x-header />
    @yield('content')

    <x-footer />

    <a href="#" class="back-to-top">
        <i class="lni-chevron-up"></i>
    </a>

    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery-min.js"></script>
    <script src="{{ asset('frontend') }}/js/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/js/color-switcher.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('frontend') }}/js/waypoints.min.js"></script>
    <script src="{{ asset('frontend') }}/js/wow.js"></script>
    <script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/js/nivo-lightbox.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.slicknav.js"></script>
    <script src="{{ asset('frontend') }}/js/main.js"></script>
    <script src="{{ asset('frontend') }}/js/form-validator.min.js"></script>
    <script src="{{ asset('frontend') }}/js/contact-form-script.min.js"></script>
    <script src="{{ asset('frontend') }}/js/summernote.js"></script>
</body>

</html>
