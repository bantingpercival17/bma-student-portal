@section('guest-navigation')
    <nav
        class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
        <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="/login">
                Baliwag Maritime Academy
            </a>
            {{-- <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button> --}}
            {{-- <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link me-2" href="../pages/sign-up.html">
                            <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                            Sign Up
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="../pages/sign-in.html">
                            <i class="fas fa-key opacity-6 text-dark me-1"></i>
                            Sign In
                        </a>
                    </li>
                </ul>
            </div> --}}

        </div>
    </nav>
@endsection

@section('app-sidebar')
    @php
    $_routes = ['home', 'academic', 'grades', 'payments', 'on-board'];
    $_icons = ['icon-home', 'icon-home', 'icon-grade', 'icon-payment', 'icon-ship'];
    @endphp
    @include('components.icon')
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @foreach ($_routes as $_key => $_route)
                <li class="nav-item">
                    <a class="nav-link  {{ Route::currentRouteName() == $_route ? 'active' : '' }}"
                        href="{{ '/student/' . $_route }}">

                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            @yield($_icons[$_key])
                        </div>
                        <span class="nav-link-text ms-1">{{ ucwords($_route) }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('app-navigation')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                @yield('beardcrumb-content')
                <h6 class="font-weight-bolder mb-0">@yield('content-title')</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user me-sm-1"></i> {{ Auth::user()->campus_email }}
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                            aria-labelledby="dropdownMenuButton">
                            {{-- <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New message</span> from Laur
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="../assets/img/small-logos/logo-spotify.svg"
                                                class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">New album</span> by Travis Scott
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                1 day
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li> --}}
                            <li>
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">

                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <form action="/logout" method="post">
                                                @csrf
                                                <div class="nav-link text-body font-weight-bold px-0">
                                                    {{-- <input type="submit" value="Sign Out"> --}}
                                                    <button type="submit" class="btn btn-secondary btn-block"> <i
                                                            class="fa fa-user me-sm-1"></i>
                                                        Sign Out
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item px-3 pe-2 d-flex align-items-center">
                        <form action="/logout" method="post">
                            @csrf
                            <div class="nav-link text-body font-weight-bold px-0">

                                <button type="submit" class="btn btn-secondary btn-sm"> <i class="fa fa-user me-sm-1"></i>
                                    Sign Out
                                </button>
                            </div>

                        </form>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>
@endsection
