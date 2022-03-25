<!--Nav Start-->
@section('nav-bar')
    <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar py-lg-0">
        <div class="container-fluid navbar-inner">

            <a href="{{-- {{ route('website.home') }} --}}" class="navbar-brand">
                <img src="{{ asset('assets/image/bma-logo-1.png') }}" alt="image"
                    class="img-fluid rounded-circle avatar-70">
                <h2 class="logo-title me-3">BALIWAG MARITIME ACADEMY</h2>
                <span class="app badge-4 ">
                </span>
            </a>
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
                    <li class="dropdown nav-item mobile-menu">
                        <a class="nav-link dropdown-toggle " data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="true">
                            Login
                        </a>
                        <ul class="dropdown-menu " data-popper-placement="bottom-start">
                            <!-- item-->
                            {{-- <li><a class="dropdown-item " href="http://bma.edu.ph:70">Employee</a></li> --}}
                            <!-- item-->
                            <li><a class="dropdown-item " href="{{ route('login') }}">Student</a></li>
                            <!-- item-->
                            <li><a class="dropdown-item " href="{{ route('applicant-login') }}">Applicant</a>
                            </li>
                        </ul>
                    </li>
                    <a href="{{ route('website.contact-us') }}" class="nav-link ">Contact Us</a>
                    </li>
                    <!-- PERCI PAKI ENABLE LANG SANA TO KUNG NKA LOGIN UNG USERS-->

                </ul>
            </div>
        </div>
    </nav>
    <div class="nav-scroller ">
        <nav class="nav nav-underline bg-soft-primary pb-0" aria-label="Secondary navigation">
            @php
                $_routes = [
                    [
                        'name' => 'Home',
                        'route' => 'website.home',
                    ],
                    [
                        'name' => 'Admission',
                        'route' => 'website.admission',
                    ],
                    [
                        'name' => 'Scholarship',
                        'route' => 'website.admission',
                    ],
                    [
                        'name' => 'About Us',
                        'route' => 'website.about-us',
                    ],
                ];
            @endphp
            <div class="d-flex" id="head-check">
                @foreach ($_routes as $_route)
                    <a class="nav-link  {{ request()->routeIs($_route['route']) ? 'active' : '' }}"
                        href="{{ route($_route['route']) }}">{{ $_route['name'] }}</a>
                @endforeach
            </div>
        </nav>
    </div>
@endsection

<!--Nav End-->
