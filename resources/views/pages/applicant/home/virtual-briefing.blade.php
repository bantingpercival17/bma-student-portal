@extends('layouts.applicant-template')
@php
$_title = 'Virtual Orientation';
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
        {{-- <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="header-title">
                    <div class="row">
                        <div class="col-md">
                            <h5 class="mb-1"><b>VIRTUAL ORIENTATION</b></h5>

                        </div>
                    </div>

                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home"
                                role="tab" aria-controls="v-pills-home" aria-selected="true">INTRODUCTION</a>
                            <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile"
                                role="tab" aria-controls="v-pills-profile" aria-selected="false">REGISTRAR</a>
                            <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                aria-selected="false">MEDICAL</a>
                            <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                                aria-selected="false">ACCOUNTING</a>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="tab-content mt-0" id="v-pills-tabContent">
                            <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="ratio ratio-16x9">
                                    <iframe class="embed-responsive-item"
                                        src="https://drive.google.com/file/d/1yQNBvlx6j19BRYm_AOBmymUEok_Y987O/preview"></iframe>

                                </div>
                                <div class="card mt-3">
                                    <h4 class="text-primary fw-bolder">SUMMARY</h4>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="ratio ratio-16x9">
                                    @if (Auth::user()->course_id == 3)
                                        <iframe class="embed-responsive-item"
                                            src="https://drive.google.com/file/d/1ehierCiGlCxQn62RY2E3efqtdUZ3Mw7g/preview"></iframe>
                                    @else
                                        <iframe class="embed-responsive-item"
                                            src="https://drive.google.com/file/d/15Z8F14tMYsJsnS2f-qUwHVF8zpExD5s8/preview"></iframe>
                                    @endif

                                </div>
                                <div class="card mt-3">
                                    <h4 class="text-primary fw-bolder">SUMMARY</h4>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                aria-labelledby="v-pills-messages-tab">
                                <div class="ratio ratio-16x9">
                                    @if (Auth::user()->course_id == 3)
                                        <iframe class="embed-responsive-item"
                                            src="https://drive.google.com/file/d/1RnaeqjBrHOZtJLoNJW2PMMJkghRIg28R/preview"></iframe>
                                    @else
                                        <iframe class="embed-responsive-item"
                                            src="https://drive.google.com/file/d/135cQRe8zPZfzmucXux3HVFf3ejJWwCl1/preview"></iframe>
                                    @endif

                                </div>
                                <div class="card mt-3">
                                    <h4 class="text-primary fw-bolder">SUMMARY</h4>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                aria-labelledby="v-pills-settings-tab">
                                <div class="ratio ratio-16x9">
                                    @if (Auth::user()->course_id == 3)
                                        <iframe class="embed-responsive-item"
                                            src="https://drive.google.com/file/d/1K06DvOVgBIQA_0wRbhevvph0nJsSVc8j/preview"></iframe>
                                    @else
                                        <iframe class="embed-responsive-item"
                                            src="https://drive.google.com/file/d/1K06DvOVgBIQA_0wRbhevvph0nJsSVc8j/preview"></iframe>
                                    @endif

                                </div>
                                <div class="card mt-3">
                                    <h4 class="text-primary fw-bolder">SUMMARY</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title"><b>VIRTUAL ORIENTATION</b></h4>
                </div>
            </div>
            <div class="card-body">
                <form id="form-wizard1" class="text-center mt-3">
                    <ul id="top-tab-list" class="p-0 row list-inline">
                        <li class="col-lg col-md col-sm text-start mb-2 active" id="account">
                            <a href="javascript:void();">

                                <span>INTRODUCTION</span>
                            </a>
                        </li>
                        <li id="personal" class="col-lg col-md col-sm mb-2 text-start">
                            <a href="javascript:void();">

                                <span>REGISTRAR</span>
                            </a>
                        </li>
                        <li id="payment" class="col-lg col-md col-sm mb-2 text-start">
                            <a href="javascript:void();">

                                <span>MEDICAL</span>
                            </a>
                        </li>
                        {{-- <li id="payment" class="col-lg col-md col-sm mb-2 text-start">
                            <a href="javascript:void();">

                                <span>ACCOUNTING</span>
                            </a>
                        </li> --}}
                        <li id="confirm" class="col-lg col-md col-sm mb-2 text-start">
                            <a href="javascript:void();">
                                <span>SUMMARY</span>
                            </a>
                        </li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card text-start mb-3">
                            <div class="ratio ratio-16x9">
                                <iframe class="embed-responsive-item"
                                    src="http://bma.edu.ph/resources/video/BRIEFING%20ORIENTATION.mp4"></iframe>

                            </div>
                        </div>
                        <button type="button" name="next" class="btn btn-primary next action-button float-end"
                            value="Next">Next</button>
                    </fieldset>
                    <fieldset>
                        <div class="form-card text-start mb-3">

                            <div class=" row">
                                @if (Auth::user()->course_id == 3)
                                    <div class="ratio ratio-16x9">
                                        <iframe class="embed-responsive-item"
                                            src="http://bma.edu.ph/resources/video/SHS-BRIEFING/SHS_REGISTRAR.mp4"></iframe>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="ratio ratio-16x9">
                                            <iframe class="embed-responsive-item"
                                                src="http://bma.edu.ph/resources/video/COLLEGE-BRIEFING/COLLEGE_REGISTRAR.mp4"></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <h4 class="fw-bolder text-primary mt-3">ENROLLMENT SCHEDULE</h4>
                                        <label for="">
                                            Enrolment is now open for Incoming 4th Class Cadets (1st Year College)
                                            from Monday-Friday at 9:00 AM to 4:00 PM
                                        </label> <br>
                                        <label for="" class="fw-bolder">
                                            Reminders:
                                        </label>
                                        <ul>
                                            <li>
                                                Only applicants who have completed and passed the Medical Examinations are
                                                qualified to enroll.
                                            </li>
                                            <li>
                                                The Academy will automatically close the enrolment system as soon as we meet
                                                our
                                                target number of enrollees without prior notice. On this note, we highly
                                                advise the
                                                applicants to fill-in the enrolment slots as soon as you complied with all
                                                the medical and enrolment requirements.
                                            </li>
                                        </ul>
                                        <h4 class="fw-bolder text-primary mt-3">ENROLLMENT REQUIREMENTS</h4>
                                        <ul>
                                            <li>4th Class or 1st Year College</li>
                                            <li>Original copy of Grade 12 Report Card or SF 9</li>
                                            <li>Original Certificate of Good Moral Conduct</li>
                                            <li>Original & Photocopy of PSA Birth Certificate</li>
                                            <li>Original Copy of Barangay Clearance</li>
                                            <li>2 pcs. 2x2 picture</li>
                                        </ul>
                                        <h4 class="fw-bolder text-primary mt-3">MODES OF ENROLLMENT</h4>
                                        <label for="" class="fw-bolder">
                                            Online Registration/Enrolment
                                        </label>
                                        <ol>
                                            <li>For the new students/midshipmen, only those who passed the entrance
                                                examination and medical shall be eligible to enroll.</li>

                                            <li>
                                                Students/midshipmen shall submit an e-copy of the enrolment requirements.
                                                Original copies may be directly submitted at the Office of the Registrar of
                                                Baliwag Maritime Academy or through LBC or any logistic facilities whichever
                                                is safe and convenient to you prior to scheduled enrolment.
                                                TO : BALIWAG MARITIME ACADEMY
                                                Office of the Registrar
                                                Km. 54 Cagayan Valley Road,
                                                San Rafael, Bulacan, 3008

                                                Kindly email us if you have sent the requirements for confirmation at
                                                registrar@bma.edu.ph or call at
                                                (044) 766-1263

                                            </li>
                                            <li>
                                                To proceed to enrolment, simply log-in on this website,
                                                bma.edu.ph/applicants with your application number and the system will
                                                automatically direct you to the flow of registration
                                            </li>
                                            <li>
                                                After your online registration/enrolment you will receive a confirmation of
                                                enrolment via email
                                            </li>
                                        </ol>
                                    </div>
                                @endif

                            </div>

                        </div>
                        <button type="button" name="next" class="btn btn-primary next action-button float-end"
                            value="Next">Next</button>
                        <button type="button" name="previous"
                            class="btn btn-dark previous action-button-previous float-end me-1"
                            value="Previous">Previous</button>
                    </fieldset>
                    <fieldset>
                        <div class="form-card text-start mb-3">
                            <div class="row">
                                @if (Auth::user()->course_id == 3)
                                    <div class="col-md-6">
                                        <div class="ratio ratio-16x9">
                                            <iframe class="embed-responsive-item"
                                                src="http://bma.edu.ph/resources/video/SHS-BRIEFING/SHS_MEDICAL.mp4"></iframe>
                                        </div>
                                        <div class="col-md"></div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="ratio ratio-16x9">
                                            <iframe class="embed-responsive-item"
                                                src="http://bma.edu.ph/resources/video/COLLEGE-BRIEFING/COLLEGE_MEDICAL.mp4"></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <h4 class="fw-bolder text-primary mt-3">CENTERPORT MEDICAL SERVICES INC</h4>
                                        <ul>
                                            <li>The accredited clinic of BMA .</li>
                                            <li>Is located at 4th Floor, Victoria Building, 429 UN Avenue, Ermita, Manila
                                            </li>
                                        </ul>
                                        <h6 class="fw-bolder text-primary mt-3">MEDICAL FEE</h6>
                                        <ul>
                                            <li>P 1, 800.00 for general check-up</li>
                                            <li>If findings occur, additional charges will be paid</li>
                                        </ul>
                                        <label for="" class="fw-bolder">
                                            Things to bring BEFORE and DURING the medical examination
                                        </label>
                                        <ol>
                                            <li>Medical Referral Form duly signed by the School Nurse and his/her
                                                representative from Baliwag Maritime Academy.</li>
                                            <li>5 pieces of 1X1 Formal ID Picture with white background only.</li>
                                            <li>Original/Xerox copy of Valid ID for Drug Test Requirement (School ID,
                                                Voter’s ID, Driver’s License, Passport, & etc.) </li>
                                            <li>Stool Specimen freshly collected in the morning of scheduled Medical
                                                Examination./li>
                                            <li>Bring your own Ballpen. </li>
                                            <li>Wear face masks/face shield.</li>
                                            <li>
                                                Bring light snacks/bottled water
                                            </li>
                                        </ol>
                                        <label for="" class="fw-bolder">
                                            IMPORTANT THINGS TO REMEMBER BEFORE AND DURING THE MEDICAL EXAMINATION
                                        </label>
                                        <ol>
                                            <li>No Appointment, No Entry Policy - Scheduled Appointment of the applicants
                                                will be posted (limited to 20 applicants only per day) every Monday and
                                                Wednesday. Only report when you have confirmed appointment.

                                            </li>
                                            <li>All applicants are required to wear proper attire during the Medical
                                                Examination. It could be limited to Smart Casual, with proper haircut, no
                                                earrings, no ripped jeans and no slippers. Not in short pants.

                                            </li>
                                            <li>The Patient must be 8 HOURS FASTING before the day of MEDICAL EXAMINATION
                                                (from 12MN until morning of medical examination).

                                            </li>
                                            <li>The clinic is open at 8AM-5PM; late comers will not be entertained. Call
                                                time 10:00 AM only.

                                            </li>
                                            <li>First come-First Serve Policy.

                                            </li>
                                            <li>If the student fails to attend on the scheduled Medical Examination, he
                                                should immediately notify the BMA Tactical Officer Mr. Robert S. Evangelista
                                                with CP No. 0968 459 1304 to inform reasons for not attending. Re-scheduling
                                                is for VALID REASON ONLY.
                                            </li>
                                        </ol>

                                    </div>
                                @endif

                            </div>
                        </div>
                        <button type="submit" name="next" class="btn btn-primary next action-button float-end"
                            value="submit">Submit</button>
                        <button type="button" name="previous"
                            class="btn btn-dark previous action-button-previous float-end me-1"
                            value="Previous">Previous</button>
                        {{-- <button type="button" name="next" class="btn btn-primary next action-button float-end"
                            value="Next">Next</button>
                        <button type="button" name="previous"
                            class="btn btn-dark previous action-button-previous float-end me-1"
                            value="Previous">Previous</button> --}}
                    </fieldset>
                    {{-- <fieldset>
                        <div class="form-card text-start">
                            <div class="ratio ratio-16x9">
                                @if (Auth::user()->course_id == 3)
                                    <iframe class="embed-responsive-item"
                                        src="https://drive.google.com/file/d/1K06DvOVgBIQA_0wRbhevvph0nJsSVc8j/preview"></iframe>
                                @else
                                    <iframe class="embed-responsive-item"
                                        src="https://drive.google.com/file/d/1K06DvOVgBIQA_0wRbhevvph0nJsSVc8j/preview"></iframe>
                                @endif

                            </div>
                            <div class="card mt-3">
                                <h4 class="text-primary fw-bolder">SUMMARY</h4>
                            </div>
                        </div>
                        <button type="submit" name="next" class="btn btn-primary next action-button float-end"
                            value="submit">Submit</button>
                        <button type="button" name="previous"
                            class="btn btn-dark previous action-button-previous float-end me-1"
                            value="Previous">Previous</button>
                    </fieldset> --}}
                    <fieldset>
                        <div class="form-card">

                            <h2 class="text-success text-center"><strong>THANK YOU!</strong></h2>
                            <br>
                            <div class="card-body">
                                <img src="http://bma.edu.ph/resources/video/closing_remarks/1.png" alt=""
                                    class="img-fluid">
                            </div>

                            <img src="http://bma.edu.ph/resources/video/closing_remarks/2.png" alt=""
                                class="img-fluid">
                            <img src="http://bma.edu.ph/resources/video/closing_remarks/3.png" alt=""
                                class="img-fluid">
                            <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">You Have Successfully Complete the Online
                                        Orientation.</h5>
                                    <a href="{{ route('applicant-view') }}"
                                        class="btn btn-outline-primary rounded-pill mt-3">Go
                                        to Medical Entrance
                                        Examination</a>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
                {{-- @if (Auth::user()->course_id != 3)
                    <h4 class="fw-bolder text-primary">ENROLLMENT SCHEDULE</h4>
                    <label for="">
                        Enrolment is now open for Incoming 4th Class Cadets (1st Year College)
                        from Monday-Friday at 9:00 AM to 4:00 PM
                    </label> <br>
                    <label for="" class="fw-bolder">
                        Reminders:
                    </label>
                    <ul>
                        <li>
                            Only applicants who have completed and passed the Medical Examinations are qualified to enroll.
                        </li>
                        <li>
                            The Academy will automatically close the enrolment system as soon as we meet our target number
                            of enrollees without prior notice. On this note, we highly advise the applicants to fill-in the
                            enrolment slots as soon as you complied with all the medical and enrolment requirements.
                        </li>
                    </ul>
                @else
                @endif --}}
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#form-wizard1').submit(function(evt) {
            $.get('virtual-orientation-complete?_applicant={{ Auth::user()->id }}', function(respond) {
                console.log(respond)
            })
            evt.preventDefault();
        })
    </script>
@endsection
