@extends('app')
@php
$_title = 'Home';
@endphp
@section('page-title', $_title)
@section('content-title', $_title)
@section('beardcrumb-content')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">BMA Student Portal</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $_title }}</li>
    </ol>
@endsection
@section('page-content')
    <div class="page-header min-height-200 border-radius-xl mt-4"
        style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ Auth::user()->student->last_name . ', ' . Auth::user()->student->first_name }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        CEO / Co-Founder
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab"
                                aria-selected="false">
                                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>document</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(154.000000, 300.000000)">
                                                    <path class="color-background"
                                                        d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                        opacity="0.603585379"></path>
                                                    <path class="color-background"
                                                        d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span class="ms-1">Messages</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab"
                                aria-selected="false">
                                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>settings</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF"
                                            fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(304.000000, 151.000000)">
                                                    <polygon class="color-background" opacity="0.596981957"
                                                        points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                                    </polygon>
                                                    <path class="color-background"
                                                        d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"
                                                        opacity="0.596981957"></path>
                                                    <path class="color-background"
                                                        d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span class="ms-1">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-4">
        <div class="card mb-4">
            <div class="card-header pb-0 p-3">
                <h5 class="mb-1"><b>PROFILE INFORMATION</b></h5>
                <p class="text-sm">Student Information of the cadet's/ student's at Baliwag Maritime Academy</p>
            </div>
            <div class="card-body p-3">

                <div class="form-view">
                    <h6 class="mb-1"><b>FULL NAME</b></h6>
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Lastname</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->last_name) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Firstname</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->first_name) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Middlename</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->middle_name) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-1 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Extension</label>
                                <span
                                    class="form-control">{{ Auth::user()->student->extention_name ? ucwords(Auth::user()->student->extention_name) : 'none' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-1 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Gender</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->sex) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Birthday</label>
                                <span class="form-control">{{ Auth::user()->student->birthday }}</span>
                            </div>
                        </div>
                        <div class="col-xl-5 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Birth Place</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->birth_place) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Civil Status</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->civil_status) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nationality</label>
                                <span class="form-control">{{ Auth::user()->student->nationality }}</span>
                            </div>
                        </div>
                    </div>


                    <h6 class="mb-1"><b>ADDRESS</b></h6>
                    <div class="row">
                        <div class="col-xl-5 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Hous no / Street / Bldg
                                    no</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->street) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Barangay</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->barangay) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Zip Code</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->zip_code) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Municipality</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->municipality) }}</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Province</label>
                                <span class="form-control">{{ ucwords(Auth::user()->student->province) }}</span>
                            </div>
                        </div>
                    </div>
                    <h6 class="mb-1"><b>CONTACT DETIALS</b></h6>
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Contact Number</label>

                                <span class="form-control">{{ Auth::user()->contact_number ?: 'Missing Value' }}</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-xl-0 mb-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email</label>
                                <span class="form-control">{{ Auth::user()->personal_email }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
