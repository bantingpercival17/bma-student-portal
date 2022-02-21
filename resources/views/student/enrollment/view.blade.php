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
@section('js')
    <script>
        $(document).ready(function() {
            var mode = $('.payment-mode').val();
            computation(mode)
        });
        $('.payment-mode').change(function() {
            var mode = $(this).val();
            computation(mode)
        })

        function computation(mode) {
            if (mode == 1) {
                console.log('Installment')
                var _tuition_fee = parseFloat($('.tuition-fee').text().replace(/,/g, ''))
                _computetion = $('.course').val() == 3 ? computetion_of_senior(_tuition_fee) :
                    computetion_of_college(_tuition_fee)
                console.log(_computetion)
                console.log(_computetion.total_tuition_fee)
                $('.final-tuition').text(_computetion.total_tuition_fee.toFixed(2).toLocaleString())
                $('.upon-enrollment').text(_computetion.upon_enrollment.toFixed(2).toLocaleString())
                $('.monthly-fee').text(_computetion.monthly.toFixed(2).toLocaleString())
            } else {
                var _tuition_fee = $('.tuition-fee').text()
                $('.final-tuition').text(_tuition_fee)
                $('.upon-enrollment').text(_tuition_fee)
                $('.monthly-fee').text('-')
                console.log('full')
            }
        }

        function computetion_of_senior(_tuition_fee) {
            _interest = 710; // This interest in Static Value
            _tuition_fee += _interest // Total Tuition Fee with Books
            var _init_tuition = parseInt($('#tuition_tags').val()) + _interest; // uition and Miscellaneous Fee
            _upon_enrollment = /* Get the 20% of Tuition and Miscellaneous */
                (_init_tuition * 0.20) + (_tuition_fee - _init_tuition)
            /* Subtract the total TFee and Additional Fee to the TFee and Miscellaneous */
            _monthly_fee = (_tuition_fee - _upon_enrollment) / 4
            return {
                "total_tuition_fee": _tuition_fee,
                'upon_enrollment': _upon_enrollment,
                'monthly': _monthly_fee
            };
        }

        function computetion_of_college(_tuition_fee) {
            console.log('College')
            total_fee = 0;
            console.log(_tuition_fee)
            _intest = (_tuition_fee * 0.035)

            console.log("Payment Interest: " + _intest);
            _total_fee = parseFloat(_tuition_fee) + parseFloat(_intest)
            _upon_enrollment = parseFloat(_tuition_fee) * 0.2
            _monthly_fee = (_total_fee - _upon_enrollment) / 4;
            return {
                "total_tuition_fee": _total_fee,
                'upon_enrollment': _upon_enrollment,
                'monthly': _monthly_fee
            };
        }
    </script>
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
                        @if ($_student->enrollment_assessment->payment_assessments->payment_transaction)
                            <div class=" d-flex profile-media align-items-top mb-2">
                                <div class="profile-dots-pills border-primary mt-1"></div>
                                <div class="ms-3">
                                    <h5 class=" mb-1">Congratulations! You are now Officially Enrolled.</h5>
                                    <div class="d-inline-block w-100">
                                        You may now download the Certificate of Enrollment.
                                        <br>
                                        <a href="{{ route('enrollment.coe') }}" class="btn btn-primary btn-sm">
                                            <svg width="20" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.2301 7.29052V3.2815C11.2301 2.85523 11.5701 2.5 12.0001 2.5C12.3851 2.5 12.7113 2.79849 12.763 3.17658L12.7701 3.2815V7.29052L17.55 7.29083C19.93 7.29083 21.8853 9.23978 21.9951 11.6704L22 11.8861V16.9254C22 19.373 20.1127 21.3822 17.768 21.495L17.56 21.5H6.44C4.06 21.5 2.11409 19.5608 2.00484 17.1213L2 16.9047L2 11.8758C2 9.4281 3.87791 7.40921 6.22199 7.29585L6.43 7.29083H11.23V13.6932L9.63 12.041C9.33 11.7312 8.84 11.7312 8.54 12.041C8.39 12.1959 8.32 12.4024 8.32 12.6089C8.32 12.7659 8.3648 12.9295 8.45952 13.0679L8.54 13.1666L11.45 16.1819C11.59 16.3368 11.79 16.4194 12 16.4194C12.1667 16.4194 12.3333 16.362 12.4653 16.2533L12.54 16.1819L15.45 13.1666C15.75 12.8568 15.75 12.3508 15.45 12.041C15.1773 11.7594 14.7475 11.7338 14.4462 11.9642L14.36 12.041L12.77 13.6932V7.29083L11.2301 7.29052Z"
                                                    fill="currentColor"></path>
                                            </svg>

                                            Download Now.
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class=" d-flex profile-media align-items-top mb-2">
                                <div class="profile-dots-pills border-primary mt-1"></div>
                                <div class="ms-3">
                                    <h5 class=" mb-1">Tuition Fee Assessment</h5>
                                    <small class=" d-inline-block row">

                                        <div class="col-md">
                                            Aprroved By:
                                            {{ Auth::user()->student->enrollment_assessment->payment_assessments->staff->user->name }}

                                        </div>
                                        <div class="col-md">
                                            {{ Auth::user()->student->enrollment_assessment->payment_assessments->created_at->format('d M-y h:m a') }}

                                        </div>


                                    </small>
                                    <div class="d-inline-block w-100">
                                        Your Payment was approved
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class=" d-flex profile-media align-items-top mb-2">
                                <div class="profile-dots-pills border-primary mt-1"></div>
                                <div class="ms-3">
                                    <h5 class=" mb-1">Tuition Fee Assessment</h5>
                                    @php
                                        $_course_semestral_fee = $_student->enrollment_assessment->payment_assessments->course_semestral_fee;
                                        $_payment_details = $_student->enrollment_assessment->payment_assessments;
                                        $_total_fee = 0;
                                    @endphp
                                    <span class="text-primary h5"><b>| PAYMENT DETAILS</b></span>

                                    <div class="d-inline-block mt-4 w-100">
                                        <div class=" row mt-2">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <small class="form-label">Mode of Payment:</small>
                                                    <br>
                                                    <label class="h5 text-info form-label">
                                                        {{ $_payment_details ? ($_payment_details->payment_mode == 1 ? 'INSTALLMENT' : 'FULL-PAYMENT') : '-' }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <small class="form-label">Tuition Fee Amount:</small>
                                                    <br>
                                                    <label class="h5 text-primary form-label">
                                                        {{ $_payment_details? ($_payment_details->course_semestral_fee_id? number_format($_payment_details->course_semestral_fee->total_payments($_payment_details), 2): number_format($_payment_details->total_paid_amount, 2)): '-' }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <small class="form-label">Less Voucher Discount:</small>
                                                    <br>
                                                    <label class="h5 text-info form-label">
                                                        {{ $_payment_details ? number_format($_payment_details->total_paid_amount->sum('payment_amount'), 2) : '-' }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <small class="form-label">Remaining Balance:</small>
                                                    <br>
                                                    <label class="h5 text-danger form-label">
                                                        {{ $_payment_details? number_format(($_payment_details->course_semestral_fee_id? $_payment_details->course_semestral_fee->total_payments($_payment_details): $_payment_details->total_payment) - $_payment_details->total_paid_amount->sum('payment_amount'),2): '-' }}
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <small class="form-label">Upon Enrollment:</small>
                                                    <br>
                                                    <label class="h5 text-primary form-label">
                                                        @if ($_payment_details->payment_mode == 1)
                                                            {{ $_payment_details? number_format($_payment_details->course_semestral_fee->upon_enrollment($_payment_details), 2): '-' }}
                                                        @else
                                                            0.00
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <small class="form-label">Monthly Fees:</small>
                                                    <br>
                                                    <label class="h5 text-primary form-label">
                                                        @if ($_payment_details->payment_mode == 1)
                                                            {{ $_payment_details? number_format($_payment_details->course_semestral_fee->monthly_fees($_payment_details), 2): '-' }}

                                                        @else
                                                            0.00
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md">
                                                <h5 class=" mb-1 fw-bolder">PAYMENT INSTRUCTION</h5>
                                                <p>For bank deposit or online fund transfer, please us the bank details
                                                    below:
                                                </p>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p>
                                                            <label for="" class="h6 fw-bolder">SENIOR HIGH
                                                                SCHOOL</label><br>
                                                            <label for="">Bank: <br>
                                                                <span class="fw-bolder text-info">LANDBANK OF THE
                                                                    PHILLIPINES</span>
                                                            </label>
                                                            <br>
                                                            <label for="">Account Name: <br>
                                                                <span class="fw-bolder text-info">BALIWAG MARITIME
                                                                    FOUNDATION,
                                                                    INC.</span>
                                                            </label><br>
                                                            <label for="">Account Number: <br>
                                                                <span class="fw-bolder text-info">0102112822</span>
                                                            </label>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p>
                                                            <label for="" class="h6 fw-bolder">COLLEGE</label><br>
                                                            <label for="">Bank: <br>
                                                                <span class="fw-bolder text-info">BANK OF COMMERCE</span>
                                                            </label>
                                                            <br>
                                                            <label for="">Account Name: <br>
                                                                <span class="fw-bolder text-info">BALIWAG MARITIME
                                                                    FOUNDATION</span>
                                                            </label><br>
                                                            <label for="">Account Number: <br>
                                                                <span class="fw-bolder text-info">062000001037</span>
                                                            </label>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <h5 class=" mb-1 fw-bolder">ENTER PAYMENT DETAILS:</h5>
                                                <form action="{{ route('enrollment.online-transaction-payment') }}"
                                                    method="post" enctype="multipart/form-data">
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
                                                            <div class="badge bg-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="form-label text-sm">AMOUNT PAID</label>
                                                        <input type="text" class="form-control" name="_amount_paid"
                                                            value="{{ old('_amount_paid') }}">
                                                        @error('_amount_paid')
                                                            <div class="badge bg-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="form-label text-sm">REFERENCE NUMBER</label>
                                                        <input type="text" class="form-control" name="_reference_number"
                                                            value="{{ old('_reference_number') }}">
                                                        @error('_reference_number')
                                                            <div class="badge bg-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="form-label text-sm">TRANSACTION TYPE</label>
                                                        <select name="_transaction_type" id="" class="form-select"
                                                            value={{ old('_transaction_type') }}>
                                                            <option value="_upon_enrollment" selected>Upon Enrollment
                                                            </option>
                                                        </select>
                                                        @error('_transaction_type')
                                                            <div class="badge bg-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="form-label text-sm">ATTACH RECEIPT</label>
                                                        <input type="file" class="form-control" name="_file"
                                                            accept=".png, .jpeg, .jpg, .pdf" value={{ old('_file') }}>
                                                        @error('_file')
                                                            <div class="badge bg-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <button class="btn btn-primary w-100" type="submit">SUBMIT</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif


                    @else
                        <div class=" d-flex profile-media align-items-top mb-2">
                            <div class="profile-dots-pills border-primary mt-1"></div>
                            <div class="ms-3">
                                @php
                                    $_assessment = $_student ? $_student->enrollment_assessment : [];
                                    $_total_fee = 0;
                                    $_monthly_fee = ['1ST MONTHLY', '2ND MONTHLY', '3RD MONTHLY', '4TH MONTHLY'];
                                    $_fees = $_assessment ? $_assessment->course_semestral_fees($_assessment)->semestral_fees($_assessment->course_semestral_fees($_assessment)->id) : [];
                                    $_course_semestral_fee = $_assessment ? $_assessment->course_semestral_fees($_assessment) : [];
                                @endphp
                                <h5 class=" mb-1">Tuition Fee Assessment Pending</h5>
                                <div class="d-inline-block w-100">
                                    @if (Auth::user()->student->enrollment_application->payment_mode === null)
                                        <form class="form-assessments-view " role="form"
                                            action="{{ route('enrollment.payment-mode') }}" method="post">
                                            @csrf
                                            <span class="text-primary h5"><b>| TERMS OF PAYMENT</b></span>
                                            <div class="row">

                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <input type="hidden" class="course"
                                                            value="{{ $_assessment->course_id }}">
                                                        <span class="text-muted"><b>MODE :</b></span>
                                                        <div class="col-sm">
                                                            <select name="mode" class="form-select payment-mode">
                                                                <option value="1">Fullpayment</option>
                                                                <option value="2">Installment</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="text-primary h5"><b>| PAYMENT DETAILS</b></span>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="" class=""><b>PARTICULARS</b></label>
                                                    @if (count($_fees) > 0)
                                                        @foreach ($_fees as $item)
                                                            <div class="row">
                                                                <div class="col-md">
                                                                    <span class="mt-2 badge bg-info">
                                                                        {{ ucwords(str_replace(['_', 'tags'], [' ', 'Fee'], $item->particular_tag)) }}</span>

                                                                </div>
                                                                <div class="col-md-4 ">
                                                                    <span class="mt-2 float-end">
                                                                        @php
                                                                            $_particular_amount = $_assessment->course_id == 3 ? $item->fees : $_course_semestral_fee->particular_tags($item->particular_tag);
                                                                            
                                                                            $_total_fee += $_particular_amount;
                                                                            //$_total_fee += $item->fees;
                                                                        @endphp
                                                                        <b>
                                                                            {{ number_format($_particular_amount, 2) }}</b>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <input type="hidden" id="tuition_tags" value="{{ $_total_fee }}">
                                                        @if ($_assessment->course_id == 3)
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
                                                                            <b>
                                                                                {{ number_format($item->particular_amount, 2) }}</b>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <span class="mt-2 badge bg-info">
                                                                Total Tution Fees</span>

                                                        </div>
                                                        <div class="col-md-4 ">
                                                            <span class="mt-2 float-end">
                                                                <b class="tuition-fee">
                                                                    {{ number_format($_total_fee, 2) }}</b>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <span class="text-muted h6"><b>PAYMENT SUMMARY</b></span>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <span class="mt-2 badge bg-info">
                                                                TOTAL TUITION FEE</span>
                                                        </div>
                                                        <div class="col-md-4 ">
                                                            <span class="mt-2 float-end">
                                                                <b
                                                                    class="final-tuition">{{ number_format($_total_fee, 2) }}</b>
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
                                                                <b
                                                                    class="upon-enrollment">{{ number_format($_total_fee, 2) }}</b>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @foreach ($_monthly_fee as $key => $_value)
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
                                                    @endforeach


                                                </div>
                                                <button type="submit"
                                                    class="btn btn-primary btn-block mt-2">SUBMIT</button>
                                            </div>
                                            <span class="text-danger mt-3">Note: The voucher will be applied after the
                                                Assessment Tuition Fee</span>
                                        </form>
                                    @else
                                        Wait for the Accouting Office for your Tuition Fee Assessment...
                                    @endif

                                </div>
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
