@extends('app-main')
@php
$_title = 'Payments';
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
    <p class="h5 fw-bolder text-danger">This Payment Panel is under Data Verification. Please wait for the correct details of
        your Payment Details and Enrollment Details</p>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <label for=""
                        class="fw-bolder text-muted h4">{{ strtoupper($_payment_details->enrollment_assessment->academic->semester) }}</label>
                    <small class="fw-bolder text-info">
                        {{ strtoupper($_payment_details->enrollment_assessment->academic->school_year) }}
                    </small>
                </div>
                <div class="card-body">
                    @php
                        
                        $_total_fee = 0;
                    @endphp
                    {{-- {{ $_payment_details }} --}}
                    @if ($_payment_details)
                        <div class="d-inline-block w-100">
                            <span class="text-primary h5"><b>| ASSESSMENT DETAILS</b></span>
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
                                            {{ $_payment_details? ($_payment_details->course_semestral_fee_id? number_format($_payment_details->course_semestral_fee->total_payments($_payment_details), 2): $_payment_details->total_paid_amount->sum('payment_amount')): '-' }}
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
                                                {{ $_payment_details? ($_payment_details->course_semestral_fee_id? number_format($_payment_details->course_semestral_fee->upon_enrollment($_payment_details), 2): $_payment_details->total_paid_amount->sum('payment_amount') / 5): '-' }}
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
                                                {{ $_payment_details? ($_payment_details->course_semestral_fee_id? number_format($_payment_details->course_semestral_fee->monthly_fees($_payment_details), 2): $_payment_details->total_paid_amount->sum('payment_amount') / 5): '-' }}

                                            @else
                                                0.00
                                            @endif
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
                            </div>

                        </div>
                    @else
                        <div class="d-inline-block w-100">
                            <span class="text-primary h5"><b>| Your Currently under Enrollment</b></span>


                        </div>
                    @endif

                </div>
            </div>

        </div>
        <div class="col-md-4">
            <p class="h5 fw-bolder text-muted">Enrollment History</p>
            <div class="mt-4">
                @foreach ($_student->enrollment_history as $_enrollment)
                    @if (!empty($_enrollment->payment_assessments))
                        <a
                            href="{{ route('payments') }}?_payment_assessment={{ base64_encode($_enrollment->payment_assessments->id) }}">
                            <div class="card  mb-xxl-0 iq-purchase" data-iq-gsap="onStart" data-iq-position-y="50"
                                data-iq-rotate="0" data-iq-trigger="scroll" data-iq-ease="power.out" data-iq-opacity="0"
                                style="transform: translate(0px, 0px); opacity: 1;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h5 class="text-primary">
                                            {{ $_enrollment->payment_assessments->payment_mode == 0 ? 'FULL-PAYMENT' : 'INSTALLMENT' }}
                                        </h5>
                                        <span class="text-primary">
                                            <svg width="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M17.7689 8.3818H22C22 4.98459 19.9644 3 16.5156 3H7.48444C4.03556 3 2 4.98459 2 8.33847V15.6615C2 19.0154 4.03556 21 7.48444 21H16.5156C19.9644 21 22 19.0154 22 15.6615V15.3495H17.7689C15.8052 15.3495 14.2133 13.7975 14.2133 11.883C14.2133 9.96849 15.8052 8.41647 17.7689 8.41647V8.3818ZM17.7689 9.87241H21.2533C21.6657 9.87241 22 10.1983 22 10.6004V13.131C21.9952 13.5311 21.6637 13.8543 21.2533 13.8589H17.8489C16.8548 13.872 15.9855 13.2084 15.76 12.2643C15.6471 11.6783 15.8056 11.0736 16.1931 10.6122C16.5805 10.1509 17.1573 9.88007 17.7689 9.87241ZM17.92 12.533H18.2489C18.6711 12.533 19.0133 12.1993 19.0133 11.7877C19.0133 11.3761 18.6711 11.0424 18.2489 11.0424H17.92C17.7181 11.0401 17.5236 11.1166 17.38 11.255C17.2364 11.3934 17.1555 11.5821 17.1556 11.779C17.1555 12.1921 17.4964 12.5282 17.92 12.533ZM6.73778 8.3818H12.3822C12.8044 8.3818 13.1467 8.04812 13.1467 7.63649C13.1467 7.22487 12.8044 6.89119 12.3822 6.89119H6.73778C6.31903 6.89116 5.9782 7.2196 5.97333 7.62783C5.97331 8.04087 6.31415 8.37705 6.73778 8.3818Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    @php
                                        $_payment_details = $_enrollment->payment_assessments;
                                    @endphp
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <small class="text-muted">REMAINING BALANCE</small>
                                            <h3> {{ $_payment_details? number_format(($_payment_details->course_semestral_fee_id? $_payment_details->course_semestral_fee->total_payments($_payment_details): $_payment_details->total_payment) - $_payment_details->total_paid_amount->sum('payment_amount'),2): '-' }}
                                            </h3>
                                        </div>

                                        <p class="mb-0 ms-2">
                                            <small>{{ ucwords($_enrollment->academic->semester) }}</small>
                                            <br>
                                            {{ $_enrollment->academic->school_year }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach

            </div>

        </div>
    </div>
@endsection
