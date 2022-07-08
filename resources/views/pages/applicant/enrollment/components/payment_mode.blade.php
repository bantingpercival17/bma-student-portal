@php
$_title = 'STEP 4: TUITION FEE ASSESSMENT';
@endphp

@section('step-3-dot')
    <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
    <h5 class="float-left mb-1 text-muted fw-bolder">
        <i>{{ $_title }}</i>
    </h5>
@endsection


@if (Auth::user()->enrollment_registration())
    @if (Auth::user()->enrollment_registration()->enrollment_application)
        @if (Auth::user()->enrollment_registration()->enrollment_assessment)
            @section('step-3-dot-active')
                <div class="timeline-dots1 border-primary text-primary">
                    <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.09C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.09V7.92C2 4.38 4.28 2 7.67 2ZM7.52 13.2C6.86 13.2 6.32 12.66 6.32 12C6.32 11.34 6.86 10.801 7.52 10.801C8.18 10.801 8.72 11.34 8.72 12C8.72 12.66 8.18 13.2 7.52 13.2ZM10.8 12C10.8 12.66 11.34 13.2 12 13.2C12.66 13.2 13.2 12.66 13.2 12C13.2 11.34 12.66 10.801 12 10.801C11.34 10.801 10.8 11.34 10.8 12ZM15.28 12C15.28 12.66 15.82 13.2 16.48 13.2C17.14 13.2 17.67 12.66 17.67 12C17.67 11.34 17.14 10.801 16.48 10.801C15.82 10.801 15.28 11.34 15.28 12Z"
                            fill="currentColor"></path>
                    </svg>
                </div>
                <h5 class="float-left mb-2 text-primary fw-bolder">
                    {{ $_title }}
                </h5>
                <div class="d-inline-block w-100">

                    @php
                        $_student = Auth::user()->enrollment_registration();
                        $_assessment = $_student ? $_student->enrollment_assessment : [];
                        $_total_fee = 0;
                        $_monthly_fee = ['1ST MONTHLY', '2ND MONTHLY', '3RD MONTHLY', '4TH MONTHLY'];
                        if ($_assessment) {
                            if ($_assessment->course_semestral_fees($_assessment)) {
                                $_fees = $_assessment->course_semestral_fees($_assessment)->semestral_fees($_assessment->course_semestral_fees($_assessment)->id);
                            } else {
                                $_fees = [];
                            }
                        } else {
                            $_fees = [];
                        }
                        //$_fees = $_assessment ? $_assessment->course_semestral_fees($_assessment)->semestral_fees($_assessment->course_semestral_fees($_assessment)->id) : [];
                        $_course_semestral_fee = $_assessment ? $_assessment->course_semestral_fees($_assessment) : [];
                    @endphp
                    @if ($_student->enrollment_application->payment_mode === null)
                        <form class="form-assessments-view " role="form"
                            action="{{ route('applicant.enrollment-payment-mode') }}" method="post">
                            @csrf
                            <span class="text-primary h5"><b>| TERMS OF PAYMENT</b></span>
                            <div class="row">

                                <div class="col-md">
                                    <div class="form-group">
                                        <input type="hidden" class="course" value="{{ $_assessment->course_id }}">
                                        <span class="text-muted"><b>MODE :</b></span>
                                        <div class="col-sm">
                                            <select name="mode" class="form-select payment-mode">
                                                <option value="0">Fullpayment</option>
                                                <option value="1">Installment</option>
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
                                <button type="submit" class="btn btn-primary btn-block mt-2">SUBMIT</button>
                            </div>
                            <span class="text-danger mt-3">Note: The voucher will be applied after the
                                Assessment Tuition Fee</span>
                        </form>
                    @else
                        Wait for the Accouting Office for your Tuition Fee Assessment...
                    @endif

                </div>
            @endsection
            @if (Auth::user()->enrollment_registration()->enrollment_assessment->payment_assessments)
                @section('step-3-dot-done')
                    <div class="timeline-dots1 border-secondary text-muted">
                        <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.091C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.091V7.92C2 4.38 4.28 2 7.67 2ZM11.43 14.99L16.18 10.24C16.52 9.9 16.52 9.35 16.18 9C15.84 8.66 15.28 8.66 14.94 9L10.81 13.13L9.06 11.38C8.72 11.04 8.16 11.04 7.82 11.38C7.48 11.72 7.48 12.27 7.82 12.62L10.2 14.99C10.37 15.16 10.59 15.24 10.81 15.24C11.04 15.24 11.26 15.16 11.43 14.99Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                    <h5 class="float-left mb-1 text-muted fw-bolder">
                        {{ $_title }}
                    </h5>
                    <div class="d-inline-block w-100">
                        @if (Auth::user()->enrollment_registration()->enrollment_application->payment_mode !== null)
                            @if ($_assessment->payment_assessments)
                                <div>
                                    @php
                                        $_course_semestral_fee = $_student->enrollment_assessment->payment_assessments->course_semestral_fee;
                                        $_payment_details = $_student->enrollment_assessment->payment_assessments;
                                        $_total_fee = 0;
                                    @endphp
                                    <span class="text-primary h5"><b>| TUITION FEE DETAILS</b></span>
                                    <div class="d-inline-block mt-2 w-100">
                                        <div class=" row mt-2">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <small class="form-label">Mode of Payment:</small>
                                                    <br>
                                                    <label class="h5 text-info form-label">
                                                        {{ $_payment_details ? ($_payment_details->payment_mode == 1 ? 'INSTALLMENT' : 'FULL-PAYMENT') : '-' }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <small class="form-label">Tuition Fee Amount:</small>
                                                    <br>
                                                    <label class="h5 text-primary form-label">
                                                        {{ $_payment_details ? ($_payment_details->course_semestral_fee_id ? number_format($_payment_details->course_semestral_fee->total_payments($_payment_details), 2) : number_format($_payment_details->total_paid_amount, 2)) : '-' }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <small class="form-label">Less Voucher Discount:</small>
                                                    <br>
                                                    <label class="h5 text-info form-label">
                                                        {{ $_payment_details ? number_format($_payment_details->total_paid_amount->sum('payment_amount'), 2) : '-' }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <small class="form-label">Remaining Balance:</small>
                                                    <br>
                                                    <label class="h5 text-danger form-label">
                                                        {{ $_payment_details ? number_format(($_payment_details->course_semestral_fee_id ? $_payment_details->course_semestral_fee->total_payments($_payment_details) : $_payment_details->total_payment) - $_payment_details->total_paid_amount->sum('payment_amount'), 2) : '-' }}
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <small class="form-label">Upon Enrollment:</small>
                                                    <br>
                                                    <label class="h5 text-primary form-label">
                                                        @if ($_payment_details->payment_mode == 1)
                                                            {{ $_payment_details ? number_format($_payment_details->course_semestral_fee->upon_enrollment($_payment_details), 2) : '-' }}
                                                        @else
                                                            {{ number_format($_payment_details->course_semestral_fee->total_payments($_payment_details), 2) }}
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <small class="form-label">Monthly Fees:</small>
                                                    <br>
                                                    <label class="h5 text-primary form-label">
                                                        @if ($_payment_details->payment_mode == 1)
                                                            {{ $_payment_details ? number_format($_payment_details->course_semestral_fee->monthly_fees($_payment_details), 2) : '-' }}
                                                        @else
                                                            0.00
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="d-inline-block mt-2 w-100">
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
                                                {{ $_payment_details ? ($_payment_details->course_semestral_fee_id ? number_format($_payment_details->course_semestral_fee->total_payments($_payment_details), 2) : number_format($_payment_details->total_paid_amount, 2)) : '-' }}
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
                                                {{ $_payment_details ? number_format(($_payment_details->course_semestral_fee_id ? $_payment_details->course_semestral_fee->total_payments($_payment_details) : $_payment_details->total_payment) - $_payment_details->total_paid_amount->sum('payment_amount'), 2) : '-' }}
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
                                                    {{ $_payment_details ? number_format($_payment_details->course_semestral_fee->upon_enrollment($_payment_details), 2) : '-' }}
                                                @else
                                                    {{ number_format($_payment_details->course_semestral_fee->total_payments($_payment_details), 2) }}
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
                                                    {{ $_payment_details ? number_format($_payment_details->course_semestral_fee->monthly_fees($_payment_details), 2) : '-' }}
                                                @else
                                                    0.00
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                                </div>
                            @else
                                Wait for the Accouting Office for your Tuition Fee Assessment...
                            @endif
                        @endif
                    </div>
                @endsection
            @endif
        @endif
    @endif
@endif
