@extends('layouts.website-template')
@php
$_title = 'Admission - Baliwag Maritime Academy';
@endphp
@section('page-title', $_title)
@section('page-content')
    <h2 class="text-primary text-center home-title">SCHOOL ADMISSION</h2>
    <div class="alert alert-left alert-success alert-dismissible fade show mt-5" role="alert">
        <span class="fw-bolder">REMINDERS TO ALL APPLICANTS:</span>

        <p class="mt-3">
            • Applicants with Tattoos are not allowed.
            <br>
            • All application documents submitted online that met the pre-qualifying requirements shall be allowed to take
            the entrance examination but will be subjected for further verification to prove its authenticity validity.
            Application documents that are proven fraudulent after verification shall be invalidated and will not be allowed
            to enroll in the Academy.
        </p>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row mt-5 ">
                <div class="col-8">
                    <h4 class="fw-bolder">SENIOR HIGH SCHOOL ADMISSION REQUIREMENTS</h4>
                    <ul class="contact-details">
                        <li> Grade 10 Report Card with Grades in English, Math,
                            Science and General Average of 80%</li>
                        <li>Certificate of Good Moral Conduct</li>
                        <li>PSA Birth Certificate (not over 19 yrs. Old)</li>
                        <li>Height Requirements: at least 5'2"</li>
                    </ul>
                    <h4 class="fw-bolder">COLLEGE ADMISSION REQUIREMENTS</h4>
                    <ul class="contact-details">
                        <li> Grade 11 & 12 Card with Grades in English, Math,
                            Science and General Average of 80%
                        </li>
                        <li> Certificate of Good Moral Conduct</li>
                        <li> PSA Birth Certificate (not over 22 yrs. Old)</li>
                        <li> Barangay Clearance</li>
                        <li> Height Requirements: at least 5'4"</li>
                    </ul>
                </div>
                <div class="col-4">
                    <h4 class="fw-bolder">APPLICATION FORM</h4>
                    <div class="contact-form mt-3">
                        <form action="{{ route('website.admission-store') }}" method="POST">
                            <div class="form-group">
                                @csrf
                                <input type="text" class="form-control" name="first_name" placeholder="First Name"
                                    value="{{ old('first_name') }}">
                                @error('first_name')
                                    <span class="badge bg-danger"> <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                    value="{{ old('last_name') }}">
                                @error('last_name')
                                    <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="" class="form-control"
                                    placeholder="Google Email Address" value="{{ old('email') }}">
                                @error('email')
                                    <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="contact_number" placeholder="Contact Number"
                                    value="{{ old('contact_number') }}">
                                @error('contact_number')
                                    <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select name="_course" id="" class="form-select" value="{{ old('_course') }}">
                                    <option value="" disable>Select Course / Strand</option>
                                    <option value="1">BS MARINE ENGINEERING - COLLEGE</option>
                                    <option value="2">BS MARINE TRANSPORTATION - COLLEGE</option>
                                    <option value="3">PRE-BACCALAUREATE - SENIOR HIGHSCHOOL</option>
                                </select>
                                @error('_course')
                                    <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-check d-block">
                                    <input class="form-check-input" type="checkbox" name="agreement"
                                        id="flexCheckDefault11">
                                    <label class="form-check-label" for="flexCheckDefault11">
                                        Terms & Agreement
                                    </label>
                                </div>
                                @error('agreement')
                                    <span class="badge bg-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            @if (Session::has('_message_errors'))
                                @foreach (Session::has('_message_errors') as $item)
                                    <span class="badge bg-danger"><strong>{{ $item }}</strong></span>
                                @endforeach
                            @endif
                            <button type="submit" class="btn btn-primary btn-rounded w-100">APPLY NOW</button>
                            <a href="{{ route('applicant-login') }}"
                                class="btn btn-info  btn-rounded w-100 text-white mt-3">
                                I ALREADY REGISTER
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
