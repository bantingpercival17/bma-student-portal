@extends('app-main')
@section('page-title', 'Login')
@section('page-content')
    {{-- <section>
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card card-plain mt-8">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-success text-gradient">BMA Student Portal</h3>
                                <p class="mb-0">Enter your email and password to sign in</p>
                            </div>
                            <div class="card-body">

                                <form method="POST" action="{{ route('login') }}" role="form">
                                    @csrf
                                    <label>Email</label>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Email" aria-label="Email"
                                            aria-describedby="email-addon" name="campus_email"
                                            value="{{ old('campus_email') }}">
                                        @error('campus_email')
                                            <p class="p-1 mb-4 text-sm mx-auto text-danger text-gradient ">
                                                {{ $message }}

                                            </p>
                                        @enderror

                                    </div>

                                    <label>Password</label>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Password"
                                            aria-label="Password" aria-describedby="password-addon" name="password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <p class="p-1 mb-4 text-sm mx-auto text-danger text-gradient ">
                                                {{ $message }}

                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remeber">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-success w-100 mt-4 mb-0">Log
                                            in</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="background-image:url('../assets/image/bma-building.png')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <div class="wrapper">
        <div class="res-hide row m-0 align-items-center vh-100">
            <div class="col-lg-5 pb-0">
                <div class="card-body auth-padding">
                    <h2 class="mb-2 text-center"><b>BMA PORTAL</b></h2>
                    <p class="text-center">SIGN IN</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control border-primary" id="email"
                                        aria-describedby="email" name="campus_email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control border-primary" id="password"
                                        aria-describedby="password" name="password">
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-between">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="customCheck1" name="remember">
                                    <label class="form-check-label" for="customCheck1">Remember Me</label>
                                </div>
                                <a href="recoverpw.html">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-md-block d-none p-0">
                <img src="{{ asset('assets/image/bma-building.png') }}" class="img-fluid gradient-main vh-100"
                    alt="images">
            </div>
        </div>
    </div>
@endsection
