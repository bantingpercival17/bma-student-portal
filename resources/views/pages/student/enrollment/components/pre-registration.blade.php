@php
$_title = 'PRE-ENROLLMENT';
@endphp

@section('step-pre-dot')
    <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
    <h5 class="float-left mb-1 text-muted fw-bolder">
        <i>{{ $_title }}</i>
    </h5>
@endsection
@section('step-pre-dot-active')
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
    <div class="d-inline-block w-100">
        <label for="" class="h6 fw-bolder">CLEARANCE</label>
        <div class="clearance">

        </div>
        <label for="" class="h6 fw-bolder">SCHEDULED APPOINTMENT</label>
        <div class="row">
            <div class="col-md">
                <p class="">
                    Should you have queries or require any clarifications, please do not hesitate to contact our Medical
                    Officer on the numbers below.<br> Tactical Officer Mr. Robert S Evangelista with contact number
                    <b>0968-459-1304</b> <br> If for any reason you wish to cancel your appointment, We appreciate a prompt
                    and early notification
                    from your side.
                    <br>
                    Looking forward to your presence.
                </p>
            </div>

            <div class="col-md-7">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.342591389652!2d120.97658231527882!3d14.579544181499985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ca2f83bf0ae3%3A0x205ff1c834bda92!2sCenterport%20Medical%20Services.%2C%20Inc.!5e0!3m2!1sen!2sph!4v1654503989120!5m2!1sen!2sph"
                    width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="schedule">
            @if (Auth::user()->student->medical_appointment)
                <p> Your appointment with Centerport Medical Services Inc. is scheduled on
                    <b>{{ date('F d, Y',strtotime(Auth::user()->student->medical_appointment->appointment_date)) }}</b>.
                </p>
                <p>Wait for the Result of Medical</p>
            @else
                <p class="">For scheduling of appointment, Kindly choose the two available schedule.</p>
                @php
                    $_first = '29';
                    $_first_date = '2022-07-29';
                    $_second = '27';
                    $_second_date = '2022-07-27';
                    $_format = 'F d, Y';
                @endphp
                <div class="row">
                    <div class="col-md">
                        <h4><span
                                class="text-info fw-bolder">{{ Auth::user()->student->medical_appointment_slot($_first_date) }}</span><small
                                class="text-secondary">/20</small>
                        </h4>

                        @if (Auth::user()->student->medical_appointment_slot($_first_date) >= 20)
                            <span class="badge bg-secondary text-white">Friday
                                {{ date($_format, strtotime($_first_date)) }} This schedule is full</span>
                        @else
                            <a href="{{ route('enrollment.medical-schedule') }}?_date={{ $_first_date }}"
                                class="btn btn-sm btn-primary">Friday
                                {{ date($_format, strtotime($_first_date)) }}</a>
                        @endif

                    </div>
                    <div class="col-md">
                        <h4><span
                                class="text-info fw-bolder">{{ Auth::user()->student->medical_appointment_slot($_second_date) }}</span><small
                                class="text-secondary">/20</small>
                        </h4>
                        @if (Auth::user()->student->medical_appointment_slot($_second_date) >= 20)
                            <span class="badge bg-secondary text-white">>Wednesday
                                {{ date($_format, strtotime($_second_date)) }} This schedule is full</span>
                        @else
                            <a href="{{ route('enrollment.medical-schedule') }}?_date={{ $_second_date }}"
                                class="btn btn-sm btn-primary">Wednesday
                                {{ date($_format, strtotime($_second_date)) }}</a>
                        @endif

                    </div>
                </div>
            @endif


        </div>
        <div class="alert alert-info mt-3 mb-3">
            <b>TAKE NOTE</b> <br>
            The medical examination day may <b>be altered or change</b> subject to:
            <br>
            a. Govt. travel restriction by IATF-DOH-LGU
            <br>
            b. Other reasons beyond control of the administration in which case re-scheduling shall be arranged and
            notice
        </div>
        <hr>

    </div>
@endsection
@section('step-pre-dot-done')
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
        <p class="mb-3">
            You can now Procude to Enrollment Assessment
        </p>
        <a href="{{ route('enrollment.registration-form') }}" target="_blank"
            class="btn btn-sm btn-outline-primary rounded-pill">Registrartion Form Printable</a>
    </div>
@endsection
