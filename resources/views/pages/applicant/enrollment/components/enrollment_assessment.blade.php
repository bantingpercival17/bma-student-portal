@php
$_title = 'STEP 2: ENROLLMENT ASSESSMENT';
@endphp


@section('step-2-dot')
    <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
    <h5 class="float-left mb-1 text-muted fw-bolder">
        <i>{{ $_title }}</i>
    </h5>
@endsection

@if (Auth::user()->enrollment_registration())
    @section('step-2-dot-active')
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
            @if (Auth::user()->enrollment_registration()->enrollment_application)
                @php
                    $_enrollment = Auth::user()->enrollment_registration()->enrollment_application;
                @endphp
                <label for="" class="form-label fw-bolder">ENROLLMENT APPLICATION DETAILS</label>
                <div class="row">
                    <div class="col-md">
                        <small class="fw-bolder">COURSE</small> <br>
                        <span class="h5 fw-bolder text-primary">{{ $_enrollment->course->course_name }}</span>
                    </div>
                    <div class="col-md">
                        <small class="fw-bolder">STRAND</small> <br>
                        <span class="h5 fw-bolder text-primary">{{ strtoupper($_enrollment->strand) }}</span>
                    </div>
                </div>
                <p class="mt-2">
                    Registrar's Office verifies your Enrollment Assessment. Make sure you have already submitted the
                    needed
                    requirements of the Registrar's Office.
                </p>
            @else
                <p class="mb-3">
                    Kindly verify your Enrollment Registration
                </p>
                <form action="{{ route('applicant.enrollment-assessment') }}" method="post">
                    @csrf
                    <div class="mt-1 mb-1 row">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="" class="fw-bolder text-muted">COURSE</label>
                                <select name="_course" id="" class="form-select">
                                    <option value="1" {{ Auth::user()->course_id == 1 ? 'selected' : '' }}>BS
                                        MARINE
                                        ENGINEERING
                                    </option>
                                    <option value="2" {{ Auth::user()->course_id == 2 ? 'selected' : '' }}>BS
                                        MARINE
                                        TRANSFORTATION</option>
                                    <option value="3" {{ Auth::user()->course_id == 3 ? 'selected' : '' }}>PBM
                                        SPECIALIZATION
                                    </option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="" class="fw-bolder text-muted">SCHOOL SEMESTER</label>
                                <input type="hidden" name="_course" value="{{ Auth::user()->course_id }}">
                                <p class="form-control">
                                    {{ Auth::user()->current_semester()->semester . ' ' . Auth::user()->current_semester()->school_year }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="" class="fw-bolder text-muted">STRAND</label>
                                <select name="_strand" id="" class="form-select" required>
                                    <option value="General Academic Strand">
                                        General
                                        Academic
                                        Strand
                                    </option>
                                    <option value="Humanities and Social Sciences Strand">
                                        Humanities
                                        and
                                        Social Sciences Strand</option>
                                    <option value="Science, Technology, Engineering and Mathematics ">
                                        Science, Technology, Engineering and
                                        Mathematics
                                    </option>
                                    <option value="Accountancy, Business and Management ">
                                        Accountancy,
                                        Business and Management </option>
                                    <option value="Technical Vocational Livelihood">
                                        Technical
                                        Vocational
                                        Livelihood</option>
                                    <option value="Pre-Baccalaureate Maritime Strand">
                                        Pre-Baccalaureate
                                        Maritime Strand</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->current_semester()->semester == 'First Semester')
                        <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill">Enroll
                            Now</button>
                    @else
                        <div class="alert alert-info">
                            Note: The School Semester was setting up, please wait for the advisory.
                            Thank you
                        </div>
                    @endif

                </form>
            @endif
        </div>
    @endsection
    @if (Auth::user()->enrollment_registration()->enrollment_application)

        @if (Auth::user()->enrollment_registration()->enrollment_application->is_approved)
            @section('step-2-dot-done')
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
                    <label for="" class="form-label fw-bolder">ENROLLMENT ASSESSMENT DETAILS</label>
                    <div class="row">
                        <div class="col-md">
                            <small class="fw-bolder">COURSE</small> <br>
                            <span
                                class="h5 fw-bolder text-primary">{{ Auth::user()->enrollment_registration()->enrollment_assessment->course->course_name }}</span>
                        </div>
                        <div class="col-md">
                            <small class="fw-bolder">YEAR LEVEL</small> <br>
                            <span
                                class="h5 fw-bolder text-primary">{{ Auth::user()->enrollment_registration()->enrollment_assessment->year_level }}TH
                                CLASS</span>
                        </div>
                        <div class="col-md">
                            <small class="fw-bolder">CURRICULUM</small> <br>
                            <span
                                class="h5 fw-bolder text-primary">{{ Auth::user()->enrollment_registration()->enrollment_assessment->curriculum->curriculum_name }}</span>
                        </div>
                    </div>
                    <p class="mb-3">
                        Enrollment Assessment Details, You can procude to the Payment Assessment.
                </div>
            @endsection
        @endif
    @endif
@endif
{{-- @section('step-2-dot-active')
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
        @if (Auth::user()->enrollment_registration()->enrollment_application)
            @php
                $_enrollment = Auth::user()->enrollment_registration()->enrollment_application;
            @endphp
            <label for="" class="form-label fw-bolder">ENROLLMENT APPLICATION DETAILS</label>
            <div class="row">
                <div class="col-md">
                    <small class="fw-bolder">COURSE</small> <br>
                    <span class="h5 fw-bolder text-primary">{{ $_enrollment->course->course_name }}</span>
                </div>
                <div class="col-md">
                    <small class="fw-bolder">STRAND</small> <br>
                    <span class="h5 fw-bolder text-primary">{{ strtoupper($_enrollment->strand) }}</span>
                </div>
            </div>
            <p class="mt-2">
                Registrar's Office verifies your Enrollment Assessment. Make sure you have already submitted the needed
                requirements of the Registrar's Office.
            </p>
        @else
            <p class="mb-3">
                Kindly verify your Enrollment Registration
            </p>
            <form action="{{ route('applicant.enrollment-assessment') }}" method="post">
                @csrf
                <div class="mt-1 mb-1 row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="" class="fw-bolder text-muted">COURSE</label>
                            <select name="_course" id="" class="form-select">
                                <option value="1" {{ Auth::user()->course_id == 1 ? 'selected' : '' }}>BS MARINE
                                    ENGINEERING
                                </option>
                                <option value="2" {{ Auth::user()->course_id == 2 ? 'selected' : '' }}>BS MARINE
                                    TRANSFORTATION</option>
                                <option value="3" {{ Auth::user()->course_id == 3 ? 'selected' : '' }}>PBM
                                    SPECIALIZATION
                                </option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="" class="fw-bolder text-muted">SCHOOL SEMESTER</label>
                            <input type="hidden" name="_course" value="{{ Auth::user()->course_id }}">
                            <p class="form-control">
                                {{ Auth::user()->current_semester()->semester . ' ' . Auth::user()->current_semester()->school_year }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="" class="fw-bolder text-muted">STRAND</label>
                            <select name="_strand" id="" class="form-select" required>
                                <option value="General Academic Strand">
                                    General
                                    Academic
                                    Strand
                                </option>
                                <option value="Humanities and Social Sciences Strand">
                                    Humanities
                                    and
                                    Social Sciences Strand</option>
                                <option value="Science, Technology, Engineering and Mathematics ">
                                    Science, Technology, Engineering and
                                    Mathematics
                                </option>
                                <option value="Accountancy, Business and Management ">
                                    Accountancy,
                                    Business and Management </option>
                                <option value="Technical Vocational Livelihood">
                                    Technical
                                    Vocational
                                    Livelihood</option>
                                <option value="Pre-Baccalaureate Maritime Strand">
                                    Pre-Baccalaureate
                                    Maritime Strand</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->current_semester()->semester == 'First Semester')
                    <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill">Enroll
                        Now</button>
                @else
                    <div class="alert alert-info">
                        Note: The School Semester was setting up, please wait for the advisory.
                        Thank you
                    </div>
                @endif

            </form>
        @endif


    </div>
@endsection --}}
