@extends('layouts.website-template')
@php
$_title = 'Applicant Login - Baliwag Maritime Academy';
@endphp
@section('page-title', $_title)
@section('page-content')
    <div class="res-hide row m-0 align-items-center">
        <div class="col-lg-5 ">
            <div class="card-body auth-padding">
                <h2 class="mb-2 text-center"><b>BMA PORTAL</b></h2>
                <p class="text-center">SIGN IN</p>
                <form method="POST" action="{{ route('applicant-login') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control border-primary" id="email" aria-describedby="email"
                                    name="email">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control border-primary" id="password"
                                    aria-describedby="password" name="password">
                            </div>
                        </div>
                        <div class="justify-content-between">
                            @if ($errors->any())
                                {!! implode('', $errors->all('<label for="" class="badge bg-danger text-small ms-2">:message</label>')) !!}
                            @endif
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
            <img src="{{ asset('assets/image/bma-building.png') }}" class="img-fluid gradient-main vh-100" alt="images">
        </div>
    </div>

@endsection
