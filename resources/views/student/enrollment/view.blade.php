@extends('app-main')
@php
$_title = 'Enrollment';
@endphp
@section('page-title', $_title)
@section('content-title', $_title)
@section('beardcrumb-content')
    <li class="breadcrumb-item active" aria-current="page">
        <svg width="14" height="14" class="me-2" viewBox="0 0 22 22" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M8.15722 19.7714V16.7047C8.1572 15.9246 8.79312 15.2908 9.58101 15.2856H12.4671C13.2587 15.2856 13.9005 15.9209 13.9005 16.7047V16.7047V19.7809C13.9003 20.4432 14.4343 20.9845 15.103 21H17.0271C18.9451 21 20.5 19.4607 20.5 17.5618V17.5618V8.83784C20.4898 8.09083 20.1355 7.38935 19.538 6.93303L12.9577 1.6853C11.8049 0.771566 10.1662 0.771566 9.01342 1.6853L2.46203 6.94256C1.86226 7.39702 1.50739 8.09967 1.5 8.84736V17.5618C1.5 19.4607 3.05488 21 4.97291 21H6.89696C7.58235 21 8.13797 20.4499 8.13797 19.7714V19.7714"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>{{ $_title }}
    </li>
@endsection
@section('page-content')

    <div class="row">
        <div class="col-md-5 ms-5">

        </div>
    </div>
    <div class="card ms-5 me-5" data-iq-gsap="onStart" data-iq-position-y="70" data-iq-rotate="0" data-iq-trigger="scroll"
        data-iq-ease="power.out" data-iq-opacity="0">
        <div class="card-header">
            <div class="header-title">
                <h4 class="card-title fw-bold">Enrollment Overview</h4>
            </div>
        </div>
        <div class="card-body">


            @if (Auth::user()->student->enrollment_application)
                @if (Auth::user()->student->enrollment_assessment && Auth::user()->student->enrollment_application->is_approved)
                    <div class=" d-flex profile-media align-items-top mb-2">
                        <div class="profile-dots-pills border-primary mt-1"></div>
                        <div class="ms-3">
                            <h5 class=" mb-1">Enrollment Assessment</h5>
                            <small class="mb-0">14 JUL 1:21 AM</small>
                        </div>
                    </div>
                @else
                    <div class=" d-flex profile-media align-items-top mb-2">
                        <div class="profile-dots-pills border-primary mt-1"></div>
                        <div class="ms-3">
                            <h5 class=" mb-1">Enrollment Assessment Pending</h5>
                        </div>
                    </div>
                @endif
                <div class=" d-flex profile-media align-items-top mb-1">
                    <div class="profile-dots-pills border-primary mt-1"></div>
                    <div class="ms-3">
                        <h5 class=" mb-1">Enrollment Application</h5>
                        <small class="mb-0">
                            {{ Auth::user()->student->enrollment_application->created_at->format('d M-y h:m a') }}
                            {{-- 15 JUL 4:50 AM --}}</small>
                    </div>
                </div>

            @else
                @if (!Auth::user()->student->current_enrollment)
                    <div class=" d-flex profile-media align-items-top mb-2">
                        <div class="profile-dots-pills border-primary mt-1"></div>
                        <div class="ms-3">
                            <h5 class=" mb-1">Start the Enrollment for Second Semester</h5>
                            <a href="{{ route('academic.enroll-now') }}" class="btn btn-primary">Enroll Now</a>
                        </div>
                    </div>
                @else
                <div class=" d-flex profile-media align-items-top mb-2">
                    <h5 class=" mb-1">Your Current Enrolled to this Semester</h5>
                    
                </div>
                @endif

            @endif

        </div>
    </div>

@endsection
