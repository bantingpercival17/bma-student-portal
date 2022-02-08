@extends('app-main')
@php
$_title = 'Academic';
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
        <div class="card">
            @php
                $_total_clearance = 0;
            @endphp
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">E-Clearance</h4>
                </div>
                <div class="card-tool">
                    @if (Auth::user()->student->enrollment_assessment->course_id == 3)
                        
                    @endif
                    <a href="{{ route('academic.enroll-now') }}" class="btn btn-primary">Enroll Now</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><b>Subject</b></th>
                                        <th><b>Status</b></th>
                                        <th><b>Comment</b></th>
                                        <th><b>Contact</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($_subject_class) > 0)
                                        @foreach ($_subject_class as $_subject)
                                            @if ($_subject->curriculum_subject->subject->subject_code != 'BRDGE' || Auth::user()->student->enrollment_assessment->bridging_program == 'with')
                                                <tr>
                                                    <td>
                                                        <b class="text-primary">
                                                            {{ $_subject->curriculum_subject->subject->subject_code }}
                                                        </b>
                                                        <br>
                                                        <small
                                                            class="text-muted"><b>{{ strtoupper($_subject->staff->user->name) }}</b></small>
                                                    </td>
                                                    <td>
                                                        @if ($_subject->e_clearance)
                                                            @if ($_subject->e_clearance->is_approved == 1)
                                                                <span class="text-primary"><b>Cleared</b></span>
                                                            @else
                                                                <span class="text-warning"><b>Not Clear</b></span><br>
                                                            @endif
                                                        @else
                                                            <span class="text-danger">-</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if ($_subject->e_clearance)
                                                            @if ($_subject->e_clearance->is_approved != 1)
                                                                <span class="text-muted">
                                                                    <b>{{ $_subject->e_clearance->comment }}</b></span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endif

                                        @endforeach
                                    @else
                                        <tr>
                                            <th colspan="4" class="text-center text-muted"> Empty Subject</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md">
                        <text-primary class="h5">Non-Academic</text-primary>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><b>Personel</b></th>
                                        <th><b>Status</b></th>
                                        <th><b>Comment</b></th>
                                        <th><b>Contact</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $_department = ['Department Head', 'Laboratory', 'Dean', 'Library', 'Exo', 'Accounting', 'Registrar', 'ICT'];
                                    @endphp
                                    @if (count($_department) > 0)
                                        @foreach ($_department as $_data)
                                            <tr>
                                                <th>
                                                    <b class="text-primary">
                                                        {{ $_data }}
                                                    </b>
                                                <td>
                                                    @if (Auth::user()->student->non_academic_clearance($_data))
                                                        @if (Auth::user()->student->non_academic_clearance($_data)->is_approved == 1)
                                                            <span class="text-primary"><b>Cleared</b></span>
                                                        @else
                                                            <span class="text-warning"><b>Not Clear</b></span><br>
                                                        @endif
                                                    @else
                                                        <span class="text-danger">-</span>
                                                    @endif
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <th colspan="4" class="text-center text-muted"> Non Academic Clearance</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
