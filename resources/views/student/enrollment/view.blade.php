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
    @php
    $_student = Auth::user()->student;
    @endphp
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

                    @if ($_student->enrollment_assessment->payment_assessments)
                        <div class=" d-flex profile-media align-items-top mb-2">
                            <div class="profile-dots-pills border-primary mt-1"></div>
                            <div class="ms-3">
                                <h5 class=" mb-1">Tuition Fee Assessment</h5>
                                @php
                                    $_course_semestral_fee = $_student->enrollment_assessment->payment_assessments->course_semestral_fee;
                                    $_total_fee = 0;
                                @endphp
                                <span class="text-primary h5"><b>| PAYMENT DETAILS</b></span>
                                <div class="row">
                                    <div class="col-md">
                                        <label for="" class=""><b>PARTICULARS</b></label>
                                        @if (count($_course_semestral_fee->semestral_fees($_course_semestral_fee->id)) > 0)
                                            @foreach ($_course_semestral_fee->semestral_fees($_course_semestral_fee->id) as $item)
                                                <div class="row">
                                                    <div class="col-md">
                                                        <span class="mt-2 badge bg-info">
                                                            {{ ucwords(str_replace(['_', 'tags'], [' ', 'Fee'], $item->particular_tag)) }}</span>

                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <span class="mt-2 float-end">
                                                            @php
                                                                $_total_fee += $item->fees;
                                                            @endphp
                                                            <b> {{ number_format($item->fees, 2) }}</b>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <input type="hidden" id="tuition_tags" value="{{ $_total_fee }}">
                                            @if ($_student->enrollment_assessment->course_id == 3)
                                                @foreach ($_course_semestral_fee->additional_fees($_course_semestral_fee->id) as $item)
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <span class="mt-2 badge bg-success">
                                                                {{ ucwords(str_replace(['_', 'tags'], [' ', 'Fee'], $item->particular_name)) }}</span>

                                                        </div>
                                                        <div class="col-md-4 ">
                                                            <span class="mt-2 float-end">
                                                                @php
                                                                    
                                                                    $_total_fee += $item->particular_amount;
                                                                @endphp
                                                                <b> {{ number_format($item->particular_amount, 2) }}</b>
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @else
                                            <div class="row">
                                                <div class="col-md">
                                                    <span class="mt-2 badge bg-info">
                                                        Please Setup the Tuition Fee
                                                    </span>

                                                </div>
                                                <div class="col-md-4 ">
                                                    <span class="mt-2 ">
                                                        <a href="{{ route('accounting.fees') }}">
                                                            <span class="mt-2 badge bg-primary">
                                                                click here
                                                            </span>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-md">
                                                <span class="mt-2 badge bg-info">
                                                    Total Tution Fees</span>

                                            </div>
                                            <div class="col-md-4 ">
                                                <span class="mt-2 float-end">
                                                    <b class="tuition-fee"> {{ number_format($_total_fee, 2) }}</b>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <span class="text-muted h6"><b>SCHEDULE PAYMENT</b></span>
                                        <div class="row">
                                            <div class="col-md">
                                                <span class="mt-2 badge bg-info">
                                                    TOTAL TUITION FEE</span>
                                            </div>
                                            <div class="col-md-4 ">
                                                <span class="mt-2 float-end">
                                                    <b class="final-tuition">{{ number_format($_total_fee, 2) }}</b>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <span class="mt-2 badge bg-info">
                                                    UPON ENROLLMENT </span>
                                            </div>
                                            <div class="col-md-4 ">
                                                <span class="mt-2 float-end">
                                                    <b class="upon-enrollment">{{ number_format($_total_fee, 2) }}</b>
                                                </span>
                                            </div>
                                        </div>{{-- @foreach ($_monthly_fee as $key => $_value)
                                            <div class="row">
                                                <div class="col-md">
                                                    <span class="mt-2 badge bg-info">
                                                        {{ $_value }} </span>

                                                </div>
                                                <div class="col-md-4 ">
                                                    <span class="mt-2 float-end">
                                                        <b class="monthly-fee">-</b>
                                                    </span>
                                                </div>
                                            </div>

                                        @endforeach --}}


                                    </div>
                                </div>
                                <div class="d-inline-block mt-4 w-100">
                                    <div class="row">
                                        <div class="col-md">
                                            <h5 class=" mb-1 fw-bolder">PAYMENT INSTRUCTION</h5>
                                            <p>For bank deposit or online fund transfer, please us the bank details below:
                                            </p>
                                            <p>
                                                <label for="" class="h6 fw-bolder">SENIOR HIGH SCHOOL</label><br>
                                                <label for="">Bank: <br>
                                                    <span class="fw-bolder text-info">LANDBANK OF THE PHILLIPINES</span>
                                                </label>
                                                <br>
                                                <label for="">Account Name: <br>
                                                    <span class="fw-bolder text-info">BALIWAG MARITIME FOUNDATION,
                                                        INC.</span>
                                                </label><br>
                                                <label for="">Account Number: <br>
                                                    <span class="fw-bolder text-info">0102112822</span>
                                                </label>
                                            </p>
                                            <p>
                                                <label for="" class="h6 fw-bolder">COLLEGE</label><br>
                                                <label for="">Bank: <br>
                                                    <span class="fw-bolder text-info">BANK OF COMMERCE</span>
                                                </label>
                                                <br>
                                                <label for="">Account Name: <br>
                                                    <span class="fw-bolder text-info">BALIWAG MARITIME FOUNDATION</span>
                                                </label><br>
                                                <label for="">Account Number: <br>
                                                    <span class="fw-bolder text-info">062000001037</span>
                                                </label>
                                            </p>

                                        </div>
                                        <div class="col-md">
                                            <h5 class=" mb-1 fw-bolder">PAYMENT DETAILS</h5>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="" class="form-label text-sm">STUDENT NUMBER</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $_student->account->student_number }}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label text-sm">STUDENT NAME</label>
                                                    <input type="text" class="form-control" name="_name"
                                                        value="{{ strtoupper($_student->first_name . ' ' . $_student->last_name) }}"
                                                        disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label text-sm">TRANSCATION DATE</label>
                                                    <input type="date" class="form-control" name="_transaction_date"
                                                        value="{{ old('_transaction_date') }}">
                                                    @error('_transaction_date')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label text-sm">AMOUNT PAID</label>
                                                    <input type="text" class="form-control" name="_amount_paid"
                                                        value="{{ old('_amount_paid') }}">
                                                    @error('_amount_paid')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label text-sm">REFERENCE NUMBER</label>
                                                    <input type="text" class="form-control" name="_reference_number"
                                                        value="{{ old('_reference_number') }}">
                                                    @error('_reference_number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label text-sm">TRANSACTION TYPE</label>
                                                    <select name="_transaction_type" id="" class="form-select"
                                                        value={{ old('_transaction_type') }}>
                                                        <option value="_upon_enrollment" selected>Upon Enrollment</option>
                                                        <option value="_graduation_fee"></option>
                                                    </select>
                                                    @error('_transaction_type')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label text-sm">ATTACH RECEIPT</label>
                                                    <input type="file" class="form-control" name="_file"
                                                        accept=".png, .jpeg, .jpg, .pdf" value={{ old('_file') }}>
                                                    @error('_file')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @else
                        <div class=" d-flex profile-media align-items-top mb-2">
                            <div class="profile-dots-pills border-primary mt-1"></div>
                            <div class="ms-3">
                                <h5 class=" mb-1">Tuition Fee Assessment Pending</h5>
                            </div>
                        </div>
                    @endif
                    <div class=" d-flex profile-media align-items-top mb-2">
                        <div class="profile-dots-pills border-primary mt-1"></div>
                        <div class="ms-3">
                            <h5 class=" mb-1">Enrollment Assessment</h5>
                            <small class=" d-inline-block">
                                {{ Auth::user()->student->enrollment_assessment->created_at->format('d M-y h:m a') }}
                                <br>
                                Aprroved By: {{ Auth::user()->student->enrollment_assessment->staff->user->name }}

                            </small>
                            <div class="d-inline-block w-100">
                                <div class="enrollment-details row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <small class="form-label">Academic Year:</small>
                                            <br>
                                            <label class="h5 text-info form-label">
                                                {{ Auth::user()->student->enrollment_assessment->academic->semester .' | ' .Auth::user()->student->enrollment_assessment->academic->school_year }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <small class="form-label">Course:</small>
                                            <br>
                                            <label class="h5 text-info form-label">
                                                {{ Auth::user()->student->enrollment_assessment->course->course_name }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <small class="form-label">Course:</small>
                                            <br>
                                            <label class="h5 text-info form-label">
                                                {{ Auth::user()->student->enrollment_assessment->course_id == 3? 'Grade ' . Auth::user()->student->enrollment_assessment->year_level: Auth::user()->student->enrollment_assessment->year_level . ' Class' }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


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
