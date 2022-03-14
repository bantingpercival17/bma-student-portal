@extends('app-main')
@php
$_title = 'School Hand Book';
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
    <div class="card">
        <div class="card-header">
            <h6><b>SCHOOL HAND BOOK</b></h6>
            @if ($_student_handbook = Auth::user()->student->student_handbook())
                <div class="form-group">
                    <div class="form-check d-block">
                        <input class="form-check-input" type="checkbox" name="status" id="flexCheckDefault2" checked
                            required>
                        <label class="form-check-label" for="flexCheckDefault2">
                            By ticking, you are confirming that you Have Read, Understood & Agree to Baliwag Maritime
                            Academy's Student Handbook
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <span class="fw-bold"><small>AGREED BY </small><span
                            class="text-primary">{{ strtoupper(Auth::user()->student->last_name . ', ' . Auth::user()->student->first_name) }}</span>
                        <small>AT</small> <span class="text-info">{{ $_student_handbook["created_at"] }}</span>
                    </span>
                </div>
            @else
                <form action="{{ route('student-handbook') }}" method="post">
                    @csrf
                    <br>
                    <div class="form-group">
                        <div class="form-check d-block">
                            <input class="form-check-input" type="checkbox" name="status" id="flexCheckDefault2" required>
                            <label class="form-check-label" for="flexCheckDefault2">
                                By ticking, you are confirming that you Have Read, Understood & Agree to Baliwag Maritime
                                Academy's Student Handbook
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm" type="submit">SUBMIT</button>
                    </div>
                </form>
            @endif

        </div>
        <div class="card-body">

            @foreach ($_documents as $item)
                <iframe src="{{ $item }}" width="100%" height="600px" frameborder="0"></iframe>
            @endforeach
        </div>

    </div>
@endsection
