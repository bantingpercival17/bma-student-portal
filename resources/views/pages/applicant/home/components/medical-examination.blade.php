@php
$_title = 'STEP 6: MEDICAL EXAMINATION';
@endphp
@section('step-6-dot')
    <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
    <h5 class="float-left mb-1 text-muted fw-bolder">
        <i>{{ $_title }}</i>
    </h5>
@endsection
@section('step-6-dot-active')
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
@section('step-6-active-content')
    @if (Auth::user()->course_id == 3)
    @else
        <div class="mb-0 mt-3">
            @if (Auth::user()->medical_appointment)
                <label for="" class="h5 fw-bolder">CHECK LIST OF MEDICAL EXAMINATION FOR INCOMING 4th CLASS</label>
                <br>
                <div>
                    <span class="fw-bolder"> A. Basic Medical Examination</span>
                    <p>

                        1. Complete Physical Examination (PE) <br>
                        2. Chest X-Ray using 11x14 plates <br>
                        3. Complete Blood Count (CBC) <br>
                        4. Blood Typing <br>
                        5. Stool Examination <br>
                        6. Urinalysis <br>
                        7. Dental Examination <br>
                        8. Neuro Psychological Examination <br>
                        9. Ishihara Test <br>
                        10. Audiometry test <br>

                    </p>
                    <span class="fw-bolder">B. Additional Laboratory examination</span>
                    <p>

                        1. HBsAg (Hepa B Test) <br>
                        2. Drug Test <br>
                        - Amphetamine <br>
                        - Cannabinoids <br>
                        3. FBS (Fasting Blood Sugar) <br>

                    </p>
                    <span class="fw-bolder">C. ECG (Electronic diagram)</span> <br>
                    <span class="fw-bolder">D. Psychology Test</span> <br>
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
                <label for="" class="h5 fw-bolder">SCHEDULED APPOINTMENT</label>
                <p>
                    Your appointment with Centerport Medical Services Inc. is scheduled on
                    <b>{{ Auth::user()->medical_appointment->appointment_date }}</b> . <br>
                </p>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.342591389652!2d120.97658231527882!3d14.579544181499985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ca2f83bf0ae3%3A0x205ff1c834bda92!2sCenterport%20Medical%20Services.%2C%20Inc.!5e0!3m2!1sen!2sph!4v1654503989120!5m2!1sen!2sph"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe> <br>
                Should you have queries or require any clarifications, please do not hesitate to contact our Medical
                Officer
                on the numbers below.
                <br> Tactical Officer Mr. Robert S Evangelista
                with contact number <b>0968-459-1304</b>
                <br>
                If for any reason you wish to cancel your appointment, We appreciate a prompt and early notification
                from
                your side.
                <br>
                Looking forward to your presence.
                <br>
                <p class="mt-3"></p>
                {{-- <p class="mt-3">Kindly download the Medical Form <a
                        href="{{ route('applicant.download-medical-form') }}"
                        class="btn btn-outline-primary btn-sm">DOWNLOAD NOW</a></p> --}}
            @else
                <p class="">For scheduling of appointment, Kindly choose the two available schedule.</p>
                @php
                    $_first = '20';
                    $_first_date = '2022-07-20';
                    $_second = '20';
                    $_second_date = '2022-07-20';
                @endphp
                <div class="row">
                    {{-- <div class="col-md">
                        <h4><span
                                class="text-info fw-bolder">{{ Auth::user()->medical_appointment_slot($_first_date) }}</span><small
                                class="text-secondary">/20</small>
                        </h4>

                        @if (Auth::user()->medical_appointment_slot($_first_date) >= 20)
                            <span class="badge bg-secondary text-white">>Monday
                                July {{ $_first }},
                                2022 This schedule is full</span>
                        @else
                            <a href="{{ route('applicant.medical-schedule') }}?_date={{ $_first }}"
                                class="btn btn-sm btn-primary">Monday
                                July {{ $_first }},
                                2022</a>
                        @endif

                    </div> --}}
                    <div class="col-md">
                        <h4><span
                                class="text-info fw-bolder">{{ Auth::user()->medical_appointment_slot($_second_date) }}</span><small
                                class="text-secondary">/20</small>
                        </h4>
                        @if (Auth::user()->medical_appointment_slot($_second_date) >= 20)
                            <span class="badge bg-secondary text-white">>Wednesday
                                July {{ $_second }},
                                2022 This schedule is full</span>
                        @else
                            <a href="{{ route('applicant.medical-schedule') }}?_date={{ $_second }}"
                                class="btn btn-sm btn-primary">Wednesday
                                July {{ $_second }},
                                2022</a>
                        @endif

                    </div>
                </div>
            @endif
        </div>
    @endif


@endsection
@section('step-6-dot-done')
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
@endsection
