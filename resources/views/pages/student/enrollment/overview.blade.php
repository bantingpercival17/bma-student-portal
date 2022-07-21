@extends('app-main')
@php
$_title = 'Enrollment';
@endphp
@section('page-title', $_title)
@section('content-title', $_title)
@section('beardcrumb-content')
    <li class="breadcrumb-item active" aria-current="page">
        <svg width="14" height="14" class="me-2" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M8.15722 19.7714V16.7047C8.1572 15.9246 8.79312 15.2908 9.58101 15.2856H12.4671C13.2587 15.2856 13.9005 15.9209 13.9005 16.7047V16.7047V19.7809C13.9003 20.4432 14.4343 20.9845 15.103 21H17.0271C18.9451 21 20.5 19.4607 20.5 17.5618V17.5618V8.83784C20.4898 8.09083 20.1355 7.38935 19.538 6.93303L12.9577 1.6853C11.8049 0.771566 10.1662 0.771566 9.01342 1.6853L2.46203 6.94256C1.86226 7.39702 1.50739 8.09967 1.5 8.84736V17.5618C1.5 19.4607 3.05488 21 4.97291 21H6.89696C7.58235 21 8.13797 20.4499 8.13797 19.7714V19.7714"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>{{ $_title }}
    </li>
@endsection
@section('js')
    <script>
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
                <h4 class="card-title fw-bold text-primary">Enrollment Overview</h4>
            </div>
        </div>
        <div class="card-body">
            @include('pages.student.enrollment.components.pre-registration')
            @include('pages.student.enrollment.components.registration')
            @include('pages.student.enrollment.components.enrollment_assessment')
            @include('pages.student.enrollment.components.payment_mode')
            @include('pages.student.enrollment.components.payment_transaction')
            @include('pages.student.enrollment.components.enrollment_complete')
            <div class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
                <ul class="list-inline p-0 m-0">
                    <li>@yield('step-pre-dot-active')</li>
                    @if (Auth::user()->student->enrollment_application)
                        <li>@yield('step-1-dot-done')</li>
                        @if (Auth::user()->student->current_enrollment && Auth::user()->student->enrollment_application->is_approved)
                            <li> @yield('step-2-dot-done')</li>
                            @if (Auth::user()->student->enrollment_assessment->payment_assessments)
                                <li> @yield('step-3-dot-done')</li>
                                @if (Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction)
                                    @if (Auth::user()->student->enrollment_assessment->payment_assessments->online_transaction->is_approved == 1)
                                        <li> @yield('step-4-dot-done')</li>
                                        <li> @yield('step-5-dot-active')</li>
                                    @else
                                        <li> @yield('step-4-dot-active')</li>
                                        <li> @yield('step-5-dot')</li>
                                    @endif
                                @else
                                    <li> @yield('step-4-dot-active')</li>
                                    <li> @yield('step-5-dot')</li>
                                @endif
                            @else
                                <li> @yield('step-3-dot-active')</li>
                                <li> @yield('step-4-dot')</li>
                                <li> @yield('step-5-dot')</li>
                            @endif
                        @else
                            <li> @yield('step-2-dot-active')</li>
                            <li> @yield('step-3-dot')</li>
                            <li> @yield('step-4-dot')</li>
                            <li> @yield('step-5-dot')</li>
                        @endif
                    @else
                        <li>@yield('step-1-dot-active')</li>
                        <li> @yield('step-2-dot')</li>
                        <li> @yield('step-3-dot')</li>
                        <li> @yield('step-4-dot')</li>
                        <li> @yield('step-5-dot')</li>
                    @endif



                </ul>
            </div>
        </div>
    </div>

@endsection
