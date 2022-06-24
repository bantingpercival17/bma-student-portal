<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/image/bma-logo-1.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/image/bma-logo-1.png') }}">
    <title>@yield('page-title') | Baliwag Maritime Academy Inc.</title>


    <link rel="stylesheet" href="{{ asset('css/app-1.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    {{-- <script src="{{ asset('js/app-1.js') }}"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
</head>

<body class=" ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader ">
            <div class="loader-body word-spacing">
                <h1 class="loader-title fw-bold">BMA APPLICANT'S PORTAL</h1>
            </div>
        </div>
    </div>

    @include('layouts.applicant-header')
    @yield('side-navigation')
    <main class="main-content">
        <div class="position-relative">
            @yield('navigation')
        </div>
        <div class="conatiner-fluid content-inner mt-6 py-0">
            @yield('page-content')
        </div>
    </main>

    @include('layouts.script')
    @yield('script')
    @yield('js')
    {{-- <script src="{{ asset('resources/js/sweetalert2.js') }}" defer></script> --}}


</body>

</html>
