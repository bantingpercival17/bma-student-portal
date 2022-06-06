@php
$_title = 'STEP 6: Medical Examination';
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
            <label for="" class="h5 fw-bolder">CHECK LIST OF MEDICAL EXAMINATION FOR INCOMING 4th CLASS</label>
            <br>
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
            <p>Kindly download the Medical Form <a href="{{route('applicant.download-medical-form')}}" class="btn btn-outline-primary btn-sm">DOWNLOAD NOW</a></p>

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
            @if (Auth::user()->medical_appointment)
                <br>
                Your appointment with Centerport Medical Services Inc. is scheduled on
                <b>{{ Auth::user()->medical_appointment->appointment_date }}</b> . <br>
                Should you have queries or require any clarifications, please do not hesitate to contact our Medical Officer
                on the numbers below.
                <br> Tactical Officer Mr. Robert S Evangelista
                with contact number <b>0968-459-1304</b>
                <br>
                If for any reason you wish to cancel your appointment, We appreciate a prompt and early notification from
                your side.
                <br>
                Looking forward to your presence.
                <br>
            @else
                <p class="">For scheduling of appointment, Kindly choose the two available schedule.
                    {{-- days contact Tactical Officer Mr. Robert S Evangelist
                with contact number <b>0968-459-1304</b> --}}
                </p>
                <div class="row">
                    <div class="col-md">
                        <h4><span
                                class="text-info fw-bolder">{{ Auth::user()->medical_appointment_slot('2022-06-13') }}</span><small
                                class="text-secondary">/20</small>
                        </h4>

                        @if (Auth::user()->medical_appointment_slot('2022-06-13') >= 20)
                            <span class="badge bg-secondary text-white">This schedule is full</span>
                        @else
                            <a href="{{ route('applicant.medical-schedule') }}?_date=13"
                                class="btn btn-sm btn-primary">Monday
                                June 13,
                                2022</a>
                        @endif

                    </div>
                    <div class="col-md">
                        <h4><span
                                class="text-info fw-bolder">{{ Auth::user()->medical_appointment_slot('2022-06-15') }}</span><small
                                class="text-secondary">/20</small>
                        </h4>
                        @if (Auth::user()->medical_appointment_slot('2022-06-15') >= 20)
                            <span class="badge bg-secondary text-white">This schedule is full</span>
                        @else
                            <a href="{{ route('applicant.medical-schedule') }}?_date=13"
                                class="btn btn-sm btn-primary">Monady
                                June 15,
                                2022</a>
                        @endif

                    </div>
                </div>
            @endif

        </div>
    @endif
@endsection
