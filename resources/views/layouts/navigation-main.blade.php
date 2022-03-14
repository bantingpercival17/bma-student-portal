@section('side-navigation')
    <aside class="sidebar sidebar-default navs-rounded-all ">
        <div class="sidebar-header d-flex align-items-center justify-content-center">
            <a href="/" class="navbar-brand">
                <img src="{{ asset('assets/image/bma-logo-1.png') }}" class="avatar-30" alt="main_logo">
                <span class="ms-1 font-weight-bold"><b>BMA Student Portal</b></span>
            </a>
            <div class="sidebar-toggle d-xl-none" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
        </div>
        <div class="sidebar-body pt-0 data-scrollbar">
            <div class="sidebar-list">
                <!-- Sidebar Menu Start -->
                @php
                    $_routes = [
                        [
                            'name' => 'Profile',
                            'route' => 'home',
                            'icon' => 'icon-home',
                        ],
                        [
                            'name' => 'Academic',
                            'route' => 'academic',
                            'icon' => 'icon-school',
                        ],
                        [
                            'name' => 'Enrollment',
                            'route' => 'enrollment',
                            'icon' => 'icon-grades',
                        ],
                        [
                            'name' => 'Payment',
                            'route' => 'payments',
                            'icon' => 'icon-payment',
                        ],
                        [
                            'name' => 'Student Handbook',
                            'route' => 'student-manual',
                            'icon' => 'icon-job',
                        ],
                    ];
                    if (Auth::user()->student->enrollment_assessment->course_id != 3) {
                        $_routes[] = [
                            'name' => 'On-board',
                            'route' => 'on-board',
                            'icon' => 'icon-job',
                        ];
                    }
                @endphp
                <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                    @foreach ($_routes as $_route)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs($_route['route']) ? 'active' : '' }}"
                                href="{{ route($_route['route']) }}">
                                <i class="icon">
                                    @include('layouts.icon-main')
                                    @yield( $_route['icon'])
                                </i>
                                <i class="sidenav-mini-icon">

                                    @yield( $_route['icon'])
                                </i>
                                <span class="item-name">{{ $_route['name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="p-2 "></div>
        </div>
    </aside>
@endsection

@section('navigation')
    <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar py-lg-0">
        <div class="container-fluid navbar-inner">
            <a href="/" class="navbar-brand">
                <span class="ms-1 font-weight-bold"><b>@yield('page-title')</b></span>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20px" height="20px" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                    </svg>
                </i>
            </div>
            <div class="input-group search-input">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-2">
                        @yield('beardcrumb-content')
                    </ol>
                </nav>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <span class="navbar-toggler-bar bar1 mt-2"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto top-menu navbar-nav align-items-center navbar-list mb-3 mb-lg-0">
                    <li>
                        <ul class="m-0 d-flex align-items-center navbar-list list-unstyled px-3 px-md-0">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul
                                    class="navbar-nav ms-auto top-menu navbar-nav align-items-center navbar-list mb-3 mb-lg-0">
                                    <li>
                                        <ul class="m-0 d-flex align-items-center navbar-list list-unstyled px-3 px-md-0">
                                            <li class="dropdown">
                                                <a class="nav-link py-0 d-flex align-items-center" href="#"
                                                    id="navbarDropdown3" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <img src="{{ asset(Auth::user()->student->profile_pic(Auth::user())) }}"
                                                        alt="User-Profile"
                                                        class="img-fluid avatar avatar-50 avatar-rounded ">
                                                    {{ str_replace('@bma.edu.ph', '', Auth::user()->campus_email) }}
                                                </a>
                                                <ul class="dropdown-menu  dropdown-menu-lg-end"
                                                    aria-labelledby="navbarDropdown3">
                                                    <li><a class="dropdown-item" href="{{ route('home') }}">My
                                                            Profile</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('student.accounts') }}">Accounts</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('logout') }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">Logout</button>
                                                        </form>

                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>


                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
@endsection
