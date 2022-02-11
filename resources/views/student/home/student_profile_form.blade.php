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
                            <p class="text-sm">Kindly double check your Student Profile <br>
                                <label for="" class="text-danger"><b>NOTE: All data field is required to fill in,
                                        type/choose N / A if not applicable</b></label>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card-body">
                <form action="{{ route('update-student-profile') }}" method="post">
                    @csrf

                    @if (count($errors) > 0)
                        @foreach ($errors as $error)
                            <label for="" class="badge bg-danger text-small mt-2">{{ $error }}</label>
                        @endforeach
                    @endif
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
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Extension</label>
                                    <input class="form-control input-extension" name="_extension_name"
                                        value="{{ (old('_extension') ?:Auth::user()->student->extention_name)? ucwords(Auth::user()->student->extention_name): '' }}">
                                    <div class="form-check">
                                        <input class="form-check-input validate-checkbox" data-input="input-extension"
                                            {{ old('_extension_name') == 'n/a' ? 'checked' : '' }} type="checkbox"
                                            value="n/a" name="_extension_name" id="flexCheckDefault2">
                                        <label class="form-check-label" for="flexCheckDefault2">
                                            none
                                        </label>
                                    </div>
                                    @error('_extension_name')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Birthday</label>
                                    <input class="form-control" type="date"
                                        value="{{ Auth::user()->student->birthday }}" name="_birthday">
                                    @error('_birthday')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Birth Place</label>
                                    <input class="form-control" type="text"
                                        value="{{ ucwords(Auth::user()->student->birth_place) }}" name="_birth_place">
                                    @error('__birth_place')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nationality</label>
                                    <input class="form-control" type="text" name="_nationality"
                                        value="{{ old('_nationality') ?: Auth::user()->student->nationality }}">
                                    @error('_nationality')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Religion</label>
                                    <input class="form-control" type="text" name="_religion"
                                        value="{{ old('_religion') ?: Auth::user()->student->religion }}">
                                    @error('_religion')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Barangay</label>
                                    <input class="form-control" type="text" name="_barangay"
                                        value={{ old('_barangay') ?: ucwords(Auth::user()->student->barangay) }}>
                                    @error('_barangay')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Zip Code</label>
                                    <input class="form-control" type="text" name="_zip_code"
                                        value={{ old('_zip_code') ?: ucwords(Auth::user()->student->zip_code) }}>
                                    @error('_zip_code')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Province</label>
                                    <input class="form-control" type="text" name="_province"
                                        value={{ old('_province') ?: ucwords(Auth::user()->student->province) }}>
                                    @error('_province')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email</label>
                                    <input class="form-control" type="text" name="_personal_email"
                                        value={{ old('_personal_email') ?: Auth::user()->personal_email ?: '' }}>
                                    @error('_personal_email')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                                    <label for=""
                                                        class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                                    <label for=""
                                                        class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                                    <label for=""
                                                        class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endforeach

                        @else
                            @foreach ($_school_level as $item)
                                @if (Auth::user()->student->current_enrollment->course_id != 3 || $item != 'Senior High School')
                                    <label for="example-text-input"
                                        class="form-control-label"><b>{{ $item }}</b></label>
                                    <div class="row">
                                        <div class="col-xl col-md-6 ">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">School
                                                    Name</label>
                                                <input class="form-control"
                                                    name="{{ str_replace(' ', '_', strtolower($item)) }}_name"
                                                    value="{{ old(str_replace(' ', '_', strtolower($item)) . '_name') }}">

                                                @error(str_replace(' ', '_', strtolower($item)) . '_name')
                                                    <label for=""
                                                        class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl col-md-6 ">
                                            <div class="form-group">
                                                <label class="form-control-label">School Address</label>
                                                <input class="form-control"
                                                    name="{{ str_replace(' ', '_', strtolower($item)) }}_address"
                                                    value="{{ old(str_replace(' ', '_', strtolower($item)) . '_address') }}">

                                                @error(str_replace(' ', '_', strtolower($item)) . '_address')
                                                    <label for=""
                                                        class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl col-md-6 ">
                                            <div class="form-group">
                                                <label class="form-control-label">Year Graduated</label>
                                                <input class="form-control" type="month"
                                                    name="{{ str_replace(' ', '_', strtolower($item)) }}_year"
                                                    value="{{ old(str_replace(' ', '_', strtolower($item)) . '_year') }}">

                                                @error(str_replace(' ', '_', strtolower($item)) . '_year')
                                                    <label for=""
                                                        class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        <hr>
                        <h6 class="mb-1"><b>PARENTS DETIALS</b></h6>
                        @php
                            $_parent_details = Auth::user()->student->parent_details;
                            $_educational_attainment = ['Elementary Graduate', 'High School Graduate', 'College', 'Vocational', "Master's / Doctorate Degree", 'Did not attend school', 'N/A'];
                            $_employment_status = ['Full Time', 'Part Time', 'Self-employed (i.e. Family Business)', 'Unemployed due to community quarantine', 'Field Work', 'None', 'N/A'];
                            $_arrangement = ['WFH', 'Office', 'Field Work', 'None', 'N/A'];
                            $_income = ['Below 10,000', '10,000-20,000', '20,000-40,000', '40,000-60,000', '60,000 Above', 'N/A'];
                        @endphp
                        <label for="example-text-input" class="form-control-label"><b>Father Information</b></label>
                        <div class="father-information">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>LAST NAME <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_father_last_name"
                                            value="{{ old('_father_last_name') ?: ($_parent_details ? ucwords($_parent_details->father_last_name) : '') }}">
                                        @error('_father_last_name')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>FIRST NAME <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_father_first_name"
                                            value="{{ old('_father_first_name') ?: ($_parent_details ? ucwords($_parent_details->father_first_name) : '') }}">
                                        @error('_father_first_name')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>MIDDLE NAME <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_father_middle_name"
                                            value="{{ old('_father_middle_name') ?: ($_parent_details ? ucwords($_parent_details->father_middle_name) : '') }}">
                                        @error('_father_middle_name')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>CONTACT NUMBER <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_father_contact_number"
                                            value="{{ old('_father_contact_number') ?: ($_parent_details ? $_parent_details->father_contact_number : '') }}">
                                        <span>
                                            @error('_father_contact_number')
                                                <label for=""
                                                    class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-xl-9 col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>HIGHEST EDUCATIONAL ATTAINMENT <span
                                                    class="text-danger">*</span></small>
                                        </label>
                                        <select name="_father_educational_attainment" class="form-select">
                                            <option value="">Select Educational Attainment</option>
                                            @foreach ($_educational_attainment as $_select_0)
                                                <option value="{{ $_select_0 }}"
                                                    {{ old('_father_educational_attainment')? (old('_father_educational_attainment') == $_select_0? 'selected': ''): ($_parent_details? ($_parent_details->father_educational_attainment == $_select_0? 'selected': ''): '') }}>
                                                    {{ $_select_0 }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('_father_educational_attainment')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>EMPLOYMENT STATUS <span class="text-danger">*</span></small>
                                        </label>
                                        <select name="_father_employment_status" class="form-select">
                                            <option value="">Select Employment Status</option>
                                            @foreach ($_employment_status as $_select_1)
                                                <option value="{{ $_select_1 }}"
                                                    {{ old('_father_employment_status')? (old('_father_employment_status') == $_select_1? 'selected': ''): ($_parent_details? ($_parent_details->father_employment_status == $_select_1? 'selected': ''): '') }}>
                                                    {{ $_select_1 }}</option>
                                            @endforeach
                                        </select>
                                        @error('_father_employment_status')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="example-text-input" class="form-control-label fw-bolder">
                                        <small>WORKING ARRANGEMENT ? <span class="text-danger">*</span></small>
                                    </label>
                                    <select name="_father_working_arrangement" class="form-select">
                                        <option value="">Select Working Arrangement</option>
                                        @foreach ($_arrangement as $_select_2)
                                            <option value="{{ $_select_2 }}"
                                                {{ old('_father_working_arrangement')? (old('_father_working_arrangement') == $_select_2? 'selected': ''): ($_parent_details? ($_parent_details->father_working_arrangement == $_select_2? 'selected': ''): '') }}>
                                                {{ $_select_2 }}</option>
                                        @endforeach
                                    </select>
                                    @error('_father_working_arrangement')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <label for="example-text-input" class="form-control-label"><b>Mother Information</b></label>
                        <div class="mother-information">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>LAST NAME <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_mother_last_name"
                                            value="{{ old('_mother_last_name') ?: ($_parent_details ? ucwords($_parent_details->mother_last_name) : '') }}">
                                        @error('_mother_last_name')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>FIRST NAME <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_mother_first_name"
                                            value="{{ old('_mother_first_name') ?: ($_parent_details ? ucwords($_parent_details->mother_first_name) : '') }}">
                                        @error('_mother_first_name')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>MIDDLE NAME <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_mother_middle_name"
                                            value="{{ old('_mother_middle_name') ?: ($_parent_details ? ucwords($_parent_details->mother_middle_name) : '') }}">
                                        @error('_mother_middle_name')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>CONTACT NUMBER <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_mother_contact_number"
                                            value="{{ old('_mother_contact_number') ?: ($_parent_details ? $_parent_details->mother_contact_number : '') }}">
                                        <span>
                                            @error('_mother_contact_number')
                                                <label for=""
                                                    class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-xl-9 col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>HIGHEST EDUCATIONAL ATTAINMENT <span
                                                    class="text-danger">*</span></small>
                                        </label>
                                        <select name="_mother_educational_attainment" class="form-select">
                                            <option value="">Select Educational Attainment</option>
                                            @foreach ($_educational_attainment as $_select_0)
                                                <option value="{{ $_select_0 }}"
                                                    {{ old('_mother_educational_attainment')? (old('_mother_educational_attainment') == $_select_0? 'selected': ''): ($_parent_details? ($_parent_details->mother_educational_attainment == $_select_0? 'selected': ''): '') }}>
                                                    {{ $_select_0 }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('_mother_educational_attainment')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>EMPLOYMENT STATUS <span class="text-danger">*</span></small>
                                        </label>
                                        <select name="_mother_employment_status" class="form-select">
                                            <option value="">Select Employment Status</option>
                                            @foreach ($_employment_status as $_select_1)
                                                <option value="{{ $_select_1 }}"
                                                    {{ old('_mother_employment_status')? (old('_mother_employment_status') == $_select_1? 'selected': ''): ($_parent_details? ($_parent_details->mother_employment_status == $_select_1? 'selected': ''): '') }}>
                                                    {{ $_select_1 }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('_mother_employment_status')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="example-text-input" class="form-control-label fw-bolder">
                                        <small>WORKING ARRANGEMENT ? <span class="text-danger">*</span></small>
                                    </label>
                                    <select name="_mother_working_arrangement" class="form-select">
                                        <option value="">Select Working Arrangement</option>
                                        @foreach ($_arrangement as $_select_2)
                                            <option value="{{ $_select_2 }}"
                                                {{ old('_mother_working_arrangement')? (old('_mother_working_arrangement') == $_select_2? 'selected': ''): ($_parent_details? ($_parent_details->mother_working_arrangement == $_select_2? 'selected': ''): '') }}>
                                                {{ $_select_2 }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('_mother_working_arrangement')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <label for="example-text-input" class="form-control-label"><b>Guardian Information</b></label>
                        <div class="guardian-information">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>LAST NAME <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_guardian_last_name"
                                            value="{{ old('_guardian_last_name') ?: ($_parent_details ? ucwords($_parent_details->guardian_last_name) : '') }}">
                                        @error('_guardian_last_name')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>FIRST NAME <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_guardian_first_name"
                                            value="{{ old('_guardian_first_name') ?: ($_parent_details ? ucwords($_parent_details->guardian_first_name) : '') }}">
                                        @error('_guardian_first_name')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>MIDDLE NAME <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_guardian_middle_name"
                                            value="{{ old('_guardian_middle_name') ?: ($_parent_details ? ucwords($_parent_details->guardian_middle_name) : '') }}">
                                        @error('_guardian_middle_name')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>CONTACT NUMBER <span class="text-danger">*</span></small>
                                        </label>
                                        <input type="text" class="form-control" name="_guardian_contact_number"
                                            value="{{ old('_guardian_contact_number') ?: ($_parent_details ? $_parent_details->guardian_contact_number : '') }}">
                                        <span>
                                            @error('_guardian_contact_number')
                                                <label for=""
                                                    class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-xl-9 col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>HIGHEST EDUCATIONAL ATTAINMENT <span
                                                    class="text-danger">*</span></small>
                                        </label>
                                        <select name="_guardian_educational_attainment" class="form-select">
                                            <option value="">Select Educational Attainment</option>
                                            @foreach ($_educational_attainment as $_select_0)
                                                <option value="{{ $_select_0 }}"
                                                    {{ old('_guardian_educational_attainment')? (old('_guardian_educational_attainment') == $_select_0? 'selected': ''): ($_parent_details? ($_parent_details->guardian_educational_attainment == $_select_0? 'selected': ''): '') }}>
                                                    {{ $_select_0 }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('_guardian_educational_attainment')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>EMPLOYMENT STATUS <span class="text-danger">*</span></small>
                                        </label>
                                        <select name="_guardian_employment_status" class="form-select">
                                            <option value="">Select Employment Status</option>
                                            @foreach ($_employment_status as $_select_1)
                                                <option value="{{ $_select_1 }}"
                                                    {{ old('_guardian_employment_status')? (old('_guardian_employment_status') == $_select_1? 'selected': ''): ($_parent_details? ($_parent_details->guardian_employment_status == $_select_1? 'selected': ''): '') }}>
                                                    {{ $_select_1 }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('_guardian_employment_status')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="example-text-input" class="form-control-label fw-bolder">
                                        <small>WORKING ARRANGEMENT ? <span class="text-danger">*</span></small>
                                    </label>
                                    <select name="_guardian_working_arrangement" class="form-select">
                                        <option value="">Select Working Arrangement</option>
                                        @foreach ($_arrangement as $_select_2)
                                            <option value="{{ $_select_2 }}"
                                                {{ old('_guardian_working_arrangement')? (old('_guardian_working_arrangement') == $_select_2? 'selected': ''): ($_parent_details? ($_parent_details->guardian_working_arrangement == $_select_2? 'selected': ''): '') }}>
                                                {{ $_select_2 }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('_guardian_working_arrangement')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label fw-bolder">
                                        <small>HOUSEHOLD INCOME <span class="text-danger">*</span></small>
                                    </label>
                                    <select name="_household_income" class="form-select">
                                        <option value="">Select Income</option>
                                        @foreach ($_income as $_select_3)
                                            <option value="{{ $_select_3 }}"
                                                {{ old('_household_income')? (old('_household_income') == $_select_3? 'selected': ''): ($_parent_details? ($_parent_details->household_income == $_select_3? 'selected': ''): '') }}>
                                                {{ $_select_3 }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('_household_income')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label fw-bolder">
                                        <small>Is your family Beneficiary of DSWD Listahan / 4P's ? <span
                                                class="text-danger">*</span></small>
                                    </label>
                                    <select name="_dswd_listahan" class="form-select">
                                        <option value="Yes"
                                            {{ old('_dswd_listahan') == 'Yes'? 'selected': ($_parent_details? ($_parent_details->dswd_listahan == 'Yes'? 'selected': ''): '') }}>
                                            Yes
                                        </option>
                                        <option value="No"
                                            {{ old('_dswd_listahan') == 'No'? 'selected': ($_parent_details? ($_parent_details->dswd_listahan == 'No'? 'selected': ''): '') }}>
                                            No
                                        </option>
                                    </select>
                                    @error('_dswd_listahan')

                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>

                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6">
                                <label for="example-text-input" class="form-control-label fw-bolder">
                                    <small>HOMEOWNERSHIP <span class="text-danger">*</span></small>
                                </label>
                                <select name="_homeownership" class="form-control">

                                    <option value="Owned"
                                        {{ old('_homeownership') == 'Owned'? 'selected': ($_parent_details? ($_parent_details->homeownership == 'Owned'? 'selected': ''): '') }}>
                                        Owned
                                    </option>

                                    <option value="Mortgaged"
                                        {{ old('_homeownership') == 'Mortgaged'? 'selected': ($_parent_details? ($_parent_details->homeownership == 'Mortgaged'? 'selected': ''): '') }}>
                                        Mortgaged

                                    </option>

                                    <option value="Rented"
                                        {{ old('_homeownership') == 'Rented'? 'selected': ($_parent_details? ($_parent_details->homeownership == 'Rented'? 'selected': ''): '') }}>
                                        Rented</option>

                                </select>

                                @error('_homeownership')

                                    <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>

                                @enderror

                            </div>

                            <div class="col-md-6">
                                <label for="example-text-input" class="form-control-label fw-bolder">
                                    <small>CAR OWNERSHIP <span class="text-danger">*</span></small>
                                </label>

                                <select name="_car_ownership" class="form-control">

                                    <option value="0"
                                        {{ old('_car_ownership') == '0'? 'selected': ($_parent_details? ($_parent_details->car_ownership == '0'? 'selected': ''): '') }}>
                                        0</option>

                                    <option value="1"
                                        {{ old('_car_ownership') == '1'? 'selected': ($_parent_details? ($_parent_details->car_ownership == '1'? 'selected': ''): '') }}>
                                        1</option>

                                    <option value="2"
                                        {{ old('_car_ownership') == '2'? 'selected': ($_parent_details? ($_parent_details->car_ownership == '2'? 'selected': ''): '') }}>
                                        2</option>

                                    <option value="3"
                                        {{ old('_car_ownership') == '3'? 'selected': ($_parent_details? ($_parent_details->car_ownership == '3'? 'selected': ''): '') }}>
                                        3</option>

                                    <option value="up to 4"
                                        {{ old('_car_ownership') == 'up to 4'? 'selected': ($_parent_details? ($_parent_details->car_ownership == 'up to 4'? 'selected': ''): '') }}>
                                        up to 4
                                    </option>

                                </select>

                                @error('_car_ownership')

                                    <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>

                                @enderror

                            </div>

                        </div>
                        <hr>
                        <h6 class="mb-1 fw-bolder">ACCESS TO DISTANCE LEARNING</h6>
                        @php
                            $_device = ['Cable TV', 'Non-Cable TV', 'Basic Cellphone', 'Smartphone', 'Table', 'Radio', 'Desktop Computer', 'Laptop', 'None'];
                            $_provider = ['own mobile data', 'own broadband (DSL, Wireless Fiber, Satellite)', 'computer shop', 'other places outside the home with internet connection (library, barangay, neighbor, relatives)', 'none'];
                            $_learning_modality = ['online learning', 'Blended', 'Face-to-Face'];
                            $_inputs = ['lack of available gadgets / equipment', 'insufficient load/data allowance', 'existing health condition/s', 'difficulty in independent learning', 'conflict with other activities (i.e. house chores)', 'none or lack of available space for studying', 'distractions (i.e. social media, noise from community/ neighbor)', 'none'];
                        @endphp
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label fw-bolder">
                                        <small>What devices are available at home that the student can use
                                            for learning? <span class="text-danger">*</span>
                                            <small class="text-warning">Check all that applies</small>
                                        </small>
                                    </label>
                                    @php
                                        $_devices_1 = $_parent_details ? unserialize($_parent_details->available_devices) : [];
                                    @endphp
                                    <div class="row  ms-2">
                                        @foreach ($_device as $_key => $_item)
                                            <div class="form-check  col-md-4">
                                                <input class="form-check-input" type="checkbox" name="_devices[]"
                                                    id="check_box_device{{ $_key }}" value="{{ $_item }}"
                                                    {{ (old('_devices')? (in_array($_item, old('_devices'))? 'checked': ''): in_array($_item, $_devices_1))? 'checked': '' }}>
                                                <label class="form-check-label"
                                                    for="check_box_device{{ $_key }}">
                                                    {{ $_item }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('_devices')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label fw-bolder">
                                        <small>Do you have a way to connect to the internet ? <span
                                                class="text-danger">*</span> </small>
                                    </label>
                                    <select name="_connection" class="form-select">
                                        <option value="Yes" {{ old('_connection') == 'Yes' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="No" {{ old('_connection') == 'No' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                    @error('_connection')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label fw-bolder">
                                        <small>How do you connect to the Internet ? <span class="text-danger">*</span>
                                            <small class="text-warning">Check all that applies</small>
                                        </small>
                                    </label>
                                    @php
                                        $_provider_1 = $_parent_details ? unserialize($_parent_details->available_provider) : [];
                                    @endphp
                                    <div class="ms-2">
                                        @foreach ($_provider as $_key => $_item)
                                            <div class="form-check  col-md-12">
                                                <input class="form-check-input" type="checkbox" name="_provider[]"
                                                    id="check_box_provider{{ $_key }}"
                                                    value="{{ $_item }}"
                                                    {{ (old('_provider')? (in_array($_item, old('_provider'))? 'checked': ''): in_array($_item, $_provider_1))? 'checked': '' }}>
                                                <label class="form-check-label"
                                                    for="check_box_provider{{ $_key }}">
                                                    {{ $_item }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('_provider')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label fw-bolder">
                                        <small>What Learning Modality do you prefer ? <span class="text-danger">*</span>
                                            <small class="text-warning">Check all that applies</small>
                                        </small>
                                    </label>
                                    @php
                                        $_learning_modality_1 = $_parent_details ? unserialize($_parent_details->learning_modality) : [];
                                    @endphp
                                    <div class="ms-2">
                                        @foreach ($_learning_modality as $_key => $_item)
                                            <div class="form-check  col-md-12">
                                                <input class="form-check-input" type="checkbox" name="_learning_modality[]"
                                                    id="check_box_learning_modality{{ $_key }}"
                                                    value="{{ $_item }}"
                                                    {{ (old('_learning_modality')? (in_array($_item, old('_learning_modality'))? 'checked': ''): in_array($_item, $_learning_modality_1))? 'checked': '' }}>
                                                <label class="form-check-label"
                                                    for="check_box_learning_modality{{ $_key }}">
                                                    {{ $_item }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('_learning_modality')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label fw-bolder">
                                        <small>What are the challenges that many affect your learning process through
                                            distance education ? <span class="text-danger">*</span>
                                            <small class="text-warning">Check all that applies</small>
                                        </small>
                                    </label>
                                    @php
                                        $_inputs_1 = $_parent_details ? unserialize($_parent_details->distance_learning_effect) : [];
                                    @endphp
                                    <div class="ms-2">
                                        @foreach ($_inputs as $_key => $_item)
                                            <div class="form-check col-md-12">
                                                <input class="form-check-input" type="checkbox" name="_inputs[]"
                                                    id="check_box_inputs{{ $_key }}" value="{{ $_item }}"
                                                    {{ (old('_inputs')? (in_array($_item, old('_inputs'))? 'checked': ''): in_array($_item, $_inputs_1))? 'checked': '' }}>
                                                <label class="form-check-label"
                                                    for="check_box_inputs{{ $_key }}">
                                                    {{ $_item }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('_inputs')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                            {!! implode('',$errors->all('<label for="" class="badge bg-danger text-small ms-2">:message</label>')) !!}
                        @endif
                        <button type="submit" class="btn btn-primary mt-2 w-100">Submit Student Information</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
