@php
$_title = ' STEP 4: Entrance Examination';
@endphp

@section('step-4-dot-active')
    <div class="timeline-dots1 border-primary text-primary">
        <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.09C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.09V7.92C2 4.38 4.28 2 7.67 2ZM7.52 13.2C6.86 13.2 6.32 12.66 6.32 12C6.32 11.34 6.86 10.801 7.52 10.801C8.18 10.801 8.72 11.34 8.72 12C8.72 12.66 8.18 13.2 7.52 13.2ZM10.8 12C10.8 12.66 11.34 13.2 12 13.2C12.66 13.2 13.2 12.66 13.2 12C13.2 11.34 12.66 10.801 12 10.801C11.34 10.801 10.8 11.34 10.8 12ZM15.28 12C15.28 12.66 15.82 13.2 16.48 13.2C17.14 13.2 17.67 12.66 17.67 12C17.67 11.34 17.14 10.801 16.48 10.801C15.82 10.801 15.28 11.34 15.28 12Z"
                fill="currentColor"></path>
        </svg>
    </div>
    <h5 class="float-left mb-1 text-primary fw-bolder">
        {{ $_title }}
    </h5>
@endsection


@section('step-4-dot-done')
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
        @if (Auth::user()->examination)
            @if (Auth::user()->examination->is_finish == 1)
                {{ Auth::user()->examination->result() }}
                @if (Auth::user()->examination->result())
                    <p class="mb-0">
                        Congratulation you Passed the Entrance Examination, Kindly wait the announcement to your email
                        account
                        for the Annoument.
                    </p>
                @else
                    <p class="mb-0">
                        Thank you
                        If you really want to go Baliwag Maritime Academy, Kindly create a letter of intent send to
                        <b>dean@bma.edu.ph </b> and <b>registar@bma.edu.ph</b>
                    </p>
                @endif
            @else
                <p class="mb-0">
                <div class="mt-3">
                    <p class="text-primary fw-bolder h5">Welcome Applicants</p>
                    <p> <span class="fw-bolder">INSTRUCTION</span></p>
                    <p class="m-0">1. Ensure that you have a strong internet connection.</p>
                    <p class="m-0">2. Once you are logged in, read carefully and understand the guidelines prior
                        to
                        and
                        after the Examination</p>
                    <p class="m-0">3. Upon completion of the Examination, click the Submit or Back button at the
                        system.</p>
                    <p class="m-0">4. You are allotted (1) hours to finish the examination.</p>
                    <a href="{{ route('applicant.entrance-examination') }}" class="btn btn-primary btn-sm">Take Entrance
                        Examination</a>
                </div>
                </p>
            @endif
        @endif


    </div>
@endsection

@section('step-4-dot')
    <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
    <h5 class="float-left mb-1 text-muted fw-bolder">
        <i>{{ $_title }}</i>
    </h5>
@endsection

@section('step-4-active-content')
    <div class="mt-3">
        <p class="text-primary fw-bolder h5">Welcome Applicants</p>
        <p> <span class="fw-bolder">INSTRUCTION</span></p>
        <p class="m-0">1. Ensure that you have a strong internet connection.</p>
        <p class="m-0">2. Once you are logged in, read carefully and understand the guidelines prior to and
            after the Examination</p>
        <p class="m-0">3. Upon completion of the Examination, click the Submit or Back button at the system.</p>
        <p class="m-0">4. You are allotted (1) hours to finish the examination.</p>
        <a href="{{ route('applicant.entrance-examination') }}" class="btn btn-primary btn-sm">Take Entrance
            Examination</a>
    </div>
@endsection