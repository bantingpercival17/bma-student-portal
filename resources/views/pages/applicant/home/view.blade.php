@extends('layouts.applicant-template')
@php
$_title = 'Applicant Information';
@endphp
@section('page-title', $_title)
@section('beardcrumb-content')
    <li class="breadcrumb-item ">
        <a href="">
            <svg width="14" height="14" class="me-2" viewBox="0 0 22 22" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.15722 19.7714V16.7047C8.1572 15.9246 8.79312 15.2908 9.58101 15.2856H12.4671C13.2587 15.2856 13.9005 15.9209 13.9005 16.7047V16.7047V19.7809C13.9003 20.4432 14.4343 20.9845 15.103 21H17.0271C18.9451 21 20.5 19.4607 20.5 17.5618V17.5618V8.83784C20.4898 8.09083 20.1355 7.38935 19.538 6.93303L12.9577 1.6853C11.8049 0.771566 10.1662 0.771566 9.01342 1.6853L2.46203 6.94256C1.86226 7.39702 1.50739 8.09967 1.5 8.84736V17.5618C1.5 19.4607 3.05488 21 4.97291 21H6.89696C7.58235 21 8.13797 20.4499 8.13797 19.7714V19.7714"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>Overview
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ $_title }}
    </li>
@endsection
@section('page-content')
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="header-title">
                    <div class="row">
                        <div class="col-md">
                            <h5 class="mb-1"><b>PROFILE INFORMATION</b></h5>
                            <label for="" class="text-danger"><b>NOTE: All data field is required to fill in,
                                    type/choose N / A if not applicable</b></label>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card-body">
                <form action="{{ route('applicant.store-detials') }}" method="post">
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
                                    <input class="form-control " value="{{ old('last_name') }}" name="last_name">
                                    @error('last_name')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">First name</label>
                                    <input class="form-control" value="{{ old('first_name') }}" name="first_name">
                                    @error('first_name')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-xl col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Middle name</label>
                                    <input class="form-control" value="{{ old('middle_name') }}" name="middle_name">
                                    <div class="form-check">
                                        <input class="form-check-input input-middle-name" type="checkbox" value="n/a"
                                            name="middle_name" id="flexCheckDefault1"
                                            {{ old('middle_name') == 'n/a' ? 'checked' : '' }}>
                                        <label class="form-check-label validate-checkbox" data-input="input-middle-name"
                                            for="flexCheckDefault1">
                                            I don't have Middle name
                                        </label>
                                    </div>
                                    @error('middle_name')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-6 ">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Extension</label>
                                    <input class="form-control input-extension" name="extention_name"
                                        value="{{ old('extension') }}">
                                    <div class="form-check">
                                        <input class="form-check-input validate-checkbox" data-input="input-extension"
                                            {{ old('extension_name') == 'n/a' ? 'checked' : '' }} type="checkbox"
                                            value="n/a" name="extention_name" id="flexCheckDefault2">
                                        <label class="form-check-label" for="flexCheckDefault2">
                                            none
                                        </label>
                                    </div>
                                    @error('extension_name')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{--  --}}
                        <div class="row">
                            <div class="col-xl-2 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Gender</label>
                                    <input class="form-control" type="text" value="{{ old('sex') }}" name="sex">
                                    @error('sex')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Birthday</label>
                                    <input class="form-control" type="date" value="{{ old('birthday') }}"
                                        name="birthday">
                                    @error('birthday')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Birth Place</label>
                                    <input class="form-control" type="text" value="{{ old('birth_place') }}"
                                        name="birth_place">
                                    @error('birth_place')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        {{-- Address --}}
                        <h6 class="mb-1"><b>ADDRESS</b></h6>
                        <div class="row">
                            <div class="col-xl-5 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">House no / Street / Bldg
                                        no</label>
                                    <input class="form-control" type="text" name="street" value="{{ old('street') }}">
                                    @error('street')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Barangay</label>
                                    <input class="form-control" type="text" name="barangay"
                                        value="{{ old('barangay') }}">
                                    @error('barangay')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Zip Code</label>
                                    <input class="form-control" type="text" name="zip_code"
                                        value="{{ old('zip_code') }}">
                                    @error('zip_code')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Municipality</label>
                                    <input type="text" name="municipality" value="{{ old('municipality') }}"
                                        class="form-control">
                                    @error('municipality')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Province</label>
                                    <input class="form-control" type="text" name="province"
                                        value="{{ old('province') }}">
                                    @error('province')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{--  --}}
                        <div class="row">
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Civil Status</label>
                                    <input class="form-control" type="text" name="civil_status"
                                        value="{{ old('civil_status') }}">
                                    @error('civil_status')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nationality</label>
                                    <input class="form-control" type="text" name="nationality"
                                        value="{{ old('nationality') }}">
                                    @error('nationality')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl col-md-6 mb-xl-0">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Religion</label>
                                    <input class="form-control" type="text" name="religion"
                                        value="{{ old('religion') }}">
                                    @error('religion')
                                        <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h6 class="mb-1"><b>EDUCATIONAL BACKGROUND</b></h6>
                        @php
                            $_school_level = ['Elementary School', 'Junior High School'];
                            $_school_level = Auth::user()->course_id == 3 ? $_school_level : ['Elementary School', 'Junior High School', 'Senior High School'];
                        @endphp
                        @foreach ($_school_level as $item)
                            <label for="example-text-input" class="form-control-label"><b>{{ $item }}</b></label>
                            <div class="row">
                                <div class="col-xl col-md-6 ">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">School
                                            Name</label>
                                        <input class="form-control"
                                            name="{{ str_replace(' ', '_', strtolower($item)) }}_name"
                                            value="{{ old(str_replace(' ', '_', strtolower($item)) . '_name') }}">

                                        @error(str_replace(' ', '_', strtolower($item)) . '_name')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <h6 class="mb-1"><b>PARENTS DETAILS</b></h6>
                        @php
                            $_parents = ['father', 'mother', 'guardian'];
                            $_educational_attainment = ['Elementary Graduate', 'High School Graduate', 'College', 'Vocational', "Master's / Doctorate Degree", 'Did not attend school', 'N/A'];
    $_employment_status = ['Full Time', 'Part Time', 'Self-employed (i.e. Family Business)', 'Unemployed due to community quarantine', 'Field Work', 'None', 'N/A'];
    $_arrangement = ['WFH', 'Office', 'Field Work', 'None', 'N/A'];
    $_income = ['Below 10,000', '10,000-20,000', '20,000-40,000', '40,000-60,000', '60,000 Above', 'N/A'];
                        @endphp
                        @foreach ($_parents as $parent)
                            <label for="example-text-input" class="form-control-label"><b>{{ ucwords($parent) }}
                                    Information</b></label>
                            <div class="{{ $parent }}-information">
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 ">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label fw-bolder">
                                                <small>LAST NAME <span class="text-danger">*</span></small>
                                            </label>
                                            <input type="text" class="form-control" name="{{ $parent }}_last_name"
                                                value="{{ old($parent . '_last_name') }}">
                                            @error($parent . '_last_name')
                                                <label for=""
                                                    class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6 ">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label fw-bolder">
                                                <small>FIRST NAME <span class="text-danger">*</span></small>
                                            </label>
                                            <input type="text" class="form-control"
                                                name="{{ $parent }}_first_name"
                                                value="{{ old($parent . '_first_name') }}">
                                            @error($parent . '_first_name')
                                                <label for=""
                                                    class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 ">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label fw-bolder">
                                                <small>MIDDLE NAME <span class="text-danger">*</span></small>
                                            </label>
                                            <input type="text" class="form-control"
                                                name="{{ $parent }}_middle_name"
                                                value="{{ old($parent . '_middle_name') }}">
                                            @error($parent . '_middle_name')
                                                <label for=""
                                                    class="badge bg-danger text-small mt-2">{{ $message }}</label>
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
                                            <input type="text" class="form-control"
                                                name="{{ $parent }}_contact_number"
                                                value="{{ old($parent . '_contact_number') }}">
                                            <span>
                                                @error($parent . '_contact_number')
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
                                            <select name="{{ $parent }}_educational_attainment"
                                                class="form-select">
                                                <option value="">Select Educational Attainment</option>
                                                @foreach ($_educational_attainment as $_select_0)
                                                    <option value="{{ $_select_0 }}"
                                                        {{ old($parent . '_educational_attainment') }}>
                                                        {{ $_select_0 }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error($parent . '_educational_attainment')
                                                <label for=""
                                                    class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label fw-bolder">
                                                <small>EMPLOYMENT STATUS <span class="text-danger">*</span></small>
                                            </label>
                                            <select name="{{ $parent }}_employment_status" class="form-select">
                                                <option value="">Select Employment Status</option>
                                                @foreach ($_employment_status as $_select_1)
                                                    <option value="{{ $_select_1 }}"
                                                        {{ old($parent . '_employment_status') }}>
                                                        {{ $_select_1 }}</option>
                                                @endforeach
                                            </select>
                                            @error($parent . '_employment_status')
                                                <label for=""
                                                    class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label for="example-text-input" class="form-control-label fw-bolder">
                                            <small>WORKING ARRANGEMENT ? <span class="text-danger">*</span></small>
                                        </label>
                                        <select name="{{ $parent }}_working_arrangement" class="form-select">
                                            <option value="">Select Working Arrangement</option>
                                            @foreach ($_arrangement as $_select_2)
                                                <option value="{{ $_select_2 }}"
                                                    {{ old($parent . '_working_arrangement') }}>
                                                    {{ $_select_2 }}</option>
                                            @endforeach
                                        </select>
                                        @error($parent . '_working_arrangement')
                                            <label for="" class="badge bg-danger text-small mt-2">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <label for="example-text-input" class="form-control-label"><b>Father Information</b></label>
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
                        </div> --}}
                        {{-- <label for="example-text-input" class="form-control-label"><b>Mother Information</b></label>
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
                        </div> --}}
                        <div class="mt-3">
                            @if ($errors->any())
                                <label for="" class="badge bg-danger text-small mt-2">{{ count($errors->all()) }}
                                    Invalid Fields</label>
                                {{-- {!! implode('', $errors->all('<label for="" class="badge bg-danger text-small ms-2">:message</label>')) !!} --}}
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 w-100">Submit Student Information</button>
                    </div>
                </form>


            </div>
        </div>
    </div>

@endsection
