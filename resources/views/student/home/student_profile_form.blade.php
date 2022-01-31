@extends('app-main')
@php
$_title = 'Profile';
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
        </svg>Home
    </li>
@endsection
@section('page-content')


    <div class="card mb-0 iq-content rounded-bottom">
        <div class="d-flex flex-wrap align-items-center justify-content-between mx-3 my-3">
            <div class="d-flex flex-wrap align-items-center">
                <div class="profile-img position-relative me-3 mb-3 mb-lg-0">
                    <img src="{{ asset(Auth::user()->student->profile_pic(Auth::user())) }}" alt="User-Profile"
                        class="img-fluid avatar avatar-90 rounded-circle">
                </div>
                <div class="d-flex align-items-center mb-3 mb-sm-0">
                    <div>
                        <h4 class="me-2 text-primary">
                            {{ Auth::user()->student->last_name . ', ' . Auth::user()->student->first_name }}</h4>
                        <span><svg width="19" height="19" class="me-2" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 10.8421C21 16.9172 12 23 12 23C12 23 3 16.9172 3 10.8421C3 4.76697 7.02944 1 12 1C16.9706 1 21 4.76697 21 10.8421Z"
                                    stroke="#07143B" stroke-width="1.5" />
                                <circle cx="12" cy="9" r="3" stroke="#07143B" stroke-width="1.5" />
                            </svg><small
                                class="mb-0 text-dark">{{ ucwords(Auth::user()->student->municipality . ', ' . Auth::user()->student->province) }}</small></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="header-title">
                    <div class="row">
                        <div class="col-md">
                            <h5 class="mb-1"><b>PROFILE INFORMATION</b></h5>
                            <p class="text-sm">Kindly double check your Student Profile</p>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card-body p-3">
                <form action="{{ route('update-student-profile') }}" method="post">
                    @csrf
                    <div class="form-view">
                        <h6 class="mb-1"><b>FULL NAME</b></h6>
                        <div class="row">
                            <div class="col-xl col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Last name</label>
                                    <input class="form-control "
                                        value="{{ old('_last_name') ?: ucwords(Auth::user()->student->last_name) }}"
                                        name="_last_name">
                                    @error('_last_name')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">First name</label>
                                    <input class="form-control"
                                        value="{{ old('_first_name') ?: ucwords(Auth::user()->student->first_name) }}"
                                        name="_first_name">
                                    @error('_first_name')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-xl col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Middle name</label>
                                    <input class="form-control"
                                        value="{{ old('_middle_name') ?: ucwords(Auth::user()->student->middle_name) }}"
                                        name="_middle_name">
                                    <div class="form-check">
                                        <input class="form-check-input input-middle-name" type="checkbox" value="n/a"
                                            name="_middle_name" id="flexCheckDefault1"
                                            {{ old('_middle_name') == 'n/a' ? 'checked' : '' }}>
                                        <label class="form-check-label validate-checkbox" data-input="input-middle-name"
                                            for="flexCheckDefault1">
                                            I don't have Middle name
                                        </label>
                                    </div>
                                    @error('_middle_name')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Extension</label>
                                    <input class="form-control input-extension" name="_extension_name"
                                        value="{{ (old('_extension') ?: Auth::user()->student->extention_name) ? ucwords(Auth::user()->student->extention_name) : '' }}">
                                    <div class="form-check">
                                        <input class="form-check-input validate-checkbox" data-input="input-extension"
                                            {{ old('_extension_name') == 'n/a' ? 'checked' : '' }} type="checkbox"
                                            value="n/a" name="_extension_name" id="flexCheckDefault2">
                                        <label class="form-check-label" for="flexCheckDefault2">
                                            none
                                        </label>
                                    </div>
                                    @error('_extension_name')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-2 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Gender</label>
                                    <input class="form-control" type="text"
                                        value="{{ ucwords(Auth::user()->student->sex) }}" name="_gender">
                                    @error('_gender')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Birthday</label>
                                    <input class="form-control" type="date"
                                        value="{{ Auth::user()->student->birthday }}" name="_birthday">
                                    @error('_birthday')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Birth Place</label>
                                    <input class="form-control" type="text"
                                        value="{{ ucwords(Auth::user()->student->birth_place) }}" name="_birth_place">
                                    @error('__birth_place')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Civil Status</label>
                                    <input class="form-control" type="text" name="_civil_status"
                                        value="{{ old('_civil_status') ?: ucwords(Auth::user()->student->civil_status) }}">
                                    @error('_civil_status')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nationality</label>
                                    <input class="form-control" type="text" name="_nationality"
                                        value="{{ old('_nationality') ?: Auth::user()->student->nationality }}">
                                    @error('_nationality')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Religion</label>
                                    <input class="form-control" type="text" name="_religion"
                                        value="{{ old('_religion') ?: Auth::user()->student->religion }}">
                                    @error('_religion')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h6 class="mb-1"><b>ADDRESS</b></h6>
                        <div class="row">
                            <div class="col-xl-5 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Hous no / Street / Bldg
                                        no</label>
                                    <input class="form-control" type="text" name="_street"
                                        value={{ old('_street') ?: ucwords(Auth::user()->student->street) }}>
                                    @error('_street')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Barangay</label>
                                    <input class="form-control" type="text" name="_barangay"
                                        value={{ old('_barangay') ?: ucwords(Auth::user()->student->barangay) }}>
                                    @error('_barangay')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Zip Code</label>
                                    <input class="form-control" type="text" name="_zip_code"
                                        value={{ old('_zip_code') ?: ucwords(Auth::user()->student->zip_code) }}>
                                    @error('_zip_code')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Municipality</label>
                                    <input type="text" name="_municipality"
                                        value={{ old('_municipality') ?: ucwords(Auth::user()->student->municipality) }}
                                        class="form-control">
                                    @error('_municipality')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Province</label>
                                    <input class="form-control" type="text" name="_province"
                                        value={{ old('_province') ?: ucwords(Auth::user()->student->province) }}>
                                    @error('_province')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h6 class="mb-1"><b>CONTACT DETIALS</b></h6>
                        <div class="row">
                            <div class="col-xl-6 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Contact Number</label>

                                    <input class="form-control" type="text" name="_contact_number"
                                        value={{ old('_contact_number') ?: Auth::user()->student->contact_number ?: '' }}>
                                    @error('_contact_number')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email</label>
                                    <input class="form-control" type="text" name="_personal_email"
                                        value={{ old('_personal_email') ?: Auth::user()->personal_email ?: '' }}>
                                    @error('_personal_email')
                                        <div class="text-danger text-small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <h6 class="mb-1"><b>EDUCATIONAL BACKGROUND</b></h6>
                        @php
                            $_school_level = ['Elementary School', 'Junior High School'];
                            $_school_level = Auth::user()->student->current_enrollment->course_id == 3 ? $_school_level : ['Elementary School', 'Junior High School', 'Senior High School'];
                        @endphp
                        @if (count(Auth::user()->student->educational_details) > 0)
                            @foreach (Auth::user()->student->educational_details as $_data)
                                @if (Auth::user()->student->current_enrollment->course_id != 3 || $_data->school_level != 'Senior High School')
                                    <label for="example-text-input"
                                        class="form-control-label"><b>{{ $_data->school_level }}</b></label>
                                    <div class="row">
                                        <div class="col-xl col-md-6 ">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">School
                                                    Name</label>
                                                <input class="form-control"
                                                    name="{{ str_replace(' ', '_', strtolower($_data->school_level)) }}_name"
                                                    value="{{ old(str_replace(' ', '_', strtolower($_data->school_level)) . '_name') ?: $_data->school_name }}">

                                                @error(str_replace(' ', '_', strtolower($_data->school_level)) . '_name')
                                                    <div class="text-danger text-small">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl col-md-6 ">
                                            <div class="form-group">
                                                <label class="form-control-label">School Address</label>
                                                <input class="form-control"
                                                    name="{{ str_replace(' ', '_', strtolower($_data->school_level)) }}_address"
                                                    value="{{ old(str_replace(' ', '_', strtolower($_data->school_level)) . '_address') ?: $_data->school_address }}">

                                                @error(str_replace(' ', '_', strtolower($_data->school_level)) . '_address')
                                                    <div class="text-danger text-small">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl col-md-6 ">
                                            <div class="form-group">
                                                <label class="form-control-label">Year Graduated</label>
                                                <input class="form-control" type="month"
                                                    name="{{ str_replace(' ', '_', strtolower($_data->school_level)) }}_year"
                                                    value="{{ old(str_replace(' ', '_', strtolower($_data->school_level)) . '_year') ?: $_data->graduated_year }}">

                                                @error(str_replace(' ', '_', strtolower($_data->school_level)) . '_year')
                                                    <div class="text-danger text-small">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endforeach

                        @else
                            @foreach ($_school_level as $item)

                            @endforeach
                        @endif
                        <h6 class="mb-1"><b>PARENTS DETIALS</b></h6>
                        @php
                            $_parent_details = Auth::user()->student->parent_details;
                        @endphp
                        <label for="example-text-input" class="form-control-label"><b>Father Information</b></label>
                        <div class="row">
                            <div class="col-xl col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Last name</label>
                                    <span
                                        class="form-control">{{ $_parent_details ? ucwords($_parent_details->father_last_name) : '-' }}</span>
                                </div>
                            </div>
                            <div class="col-xl col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">First name</label>
                                    <span
                                        class="form-control">{{ $_parent_details ? ucwords($_parent_details->father_first_name) : '-' }}</span>
                                </div>
                            </div>
                            <div class="col-xl col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Middle name</label>
                                    <span
                                        class="form-control">{{ $_parent_details ? ucwords($_parent_details->father_middle_name) : '-' }}</span>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Contact Number</label>
                                    <span
                                        class="form-control">{{ $_parent_details ? ucwords($_parent_details->father_contact_number) : '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <label for="example-text-input" class="form-control-label"><b>Mother Information</b></label>
                        <div class="row">
                            <div class="col-xl col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Last name</label>
                                    <span
                                        class="form-control">{{ $_parent_details ? ucwords($_parent_details->mother_last_name) : '-' }}</span>
                                </div>
                            </div>
                            <div class="col-xl col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">First name</label>
                                    <span
                                        class="form-control">{{ $_parent_details ? ucwords($_parent_details->mother_first_name) : '-' }}</span>
                                </div>
                            </div>
                            <div class="col-xl col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Middle name</label>
                                    <span
                                        class="form-control">{{ $_parent_details ? ucwords($_parent_details->mother_middle_name) : '-' }}</span>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Contact Number</label>
                                    <span
                                        class="form-control">{{ $_parent_details ? ucwords($_parent_details->mother_contact_number) : '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Submit Student Information</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
