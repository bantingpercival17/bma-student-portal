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
                <h1 class="loader-title fw-bold">BMA PORTAL</h1>
            </div>
        </div>
    </div>
    <!-- loader END -->

    @if (Auth::user())
        @include('layouts.navigation-main')
        @yield('side-navigation')
        <main class="main-content">
            <div class="position-relative">
                @yield('navigation')
            </div>
            @if (request()->is('student/academic*'))
                <nav class="nav nav-underline bg-soft-primary pb-0 text-center" aria-label="Secondary navigation">
                    <div class="dropdown mt-3 w-100">
                        <a class=" dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <span class="text-muted">Academic Year :</span>
                            <b>{{ Auth::user()->student->current_enrollment->academic->semester }} |
                                {{ Auth::user()->student->current_enrollment->academic->school_year }}</b>
                        </a>
                        <ul class="dropdown-menu w-100" data-popper-placement="bottom-start">
                            @php
                                $_url = route('academic');
                                $_url = request()->is('student/academic/grades') ? route('academic.grades') : $_url;
                                $_url = request()->is('student/academic/clearance') ? route('academic.clearance') : $_url;
                            @endphp
                            @if (count(Auth::user()->student->enrollment_history) > 0)
                                @foreach (Auth::user()->student->enrollment_history as $_data)
                                    <li>
                                        <a class="dropdown-item "
                                            href="{{ $_url }}?_academic={{ base64_encode($_data->academic->id) }}">
                                            {{ $_data->academic->semester }} |
                                            {{ $_data->academic->school_year }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </nav>
                <div class="nav-scroller text-center">
                    <nav class="nav nav-underline bg-soft-primary pb-0" aria-label="Secondary navigation">

                        <div class="d-flex" id="head-check">

                            <a href="{{ route('academic') }}?_academic={{ request()->input('_academic') }}"
                                class="nav-link {{ request()->is('student/academic/subjects') || request()->is('student/academic') ? 'active' : '' }}">Subjects</a>

                            <a href="{{ route('academic.grades') }}?_academic={{ request()->input('_academic') }}"
                                class="nav-link {{ request()->is('student/academic/grades') ? 'active' : '' }}">Grades</a>

                            <a href="{{ route('academic.clearance') }}?_academic={{ request()->input('_academic') }}"
                                class="nav-link {{ request()->is('student/academic/clearance') ? 'active' : '' }}">Clearance</a>

                        </div>
                    </nav>
                </div>
            @endif
            <div class="conatiner-fluid content-inner mt-6 py-0">
                @yield('page-content')
            </div>
        </main>
    @else
        @yield('page-content')
    @endif
    @include('layouts.script')
    @yield('script')
    @yield('js')
    {{-- <script src="{{ asset('resources/js/sweetalert2.js') }}" defer></script> --}}


</body>

</html>
