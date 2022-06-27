@php
$_title = 'PRE-REGISTRATION: APPLICANT ACCOUNT & COURSE';
@endphp

@section('step-0-dot-done')
    <div class="timeline-dots1 border-secondary text-muted">
        <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.091C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.091V7.92C2 4.38 4.28 2 7.67 2ZM11.43 14.99L16.18 10.24C16.52 9.9 16.52 9.35 16.18 9C15.84 8.66 15.28 8.66 14.94 9L10.81 13.13L9.06 11.38C8.72 11.04 8.16 11.04 7.82 11.38C7.48 11.72 7.48 12.27 7.82 12.62L10.2 14.99C10.37 15.16 10.59 15.24 10.81 15.24C11.04 15.24 11.26 15.16 11.43 14.99Z"
                fill="currentColor"></path>
        </svg>
    </div>
    <h5 class="float-left text-muted mb-1 fw-bolder">PRE-REGISTRATION: Applicant Account & Course</h5>
    <small class="float-right mt-1">Completion Date:
        {{ Auth::user()->created_at->format('d F Y') }}</small>
    <div class="d-inline-block w-100">
        <p class="mt-2">
        <div class="form-group mb-0">
            <label for="">COURSE:</label>
            <label for="" class="fw-bolder">{{ Auth::user()->course->course_name }}</label>

        </div>
        <div class="form-group mb-0 ">
            <label for="">NAME:</label>
            <label for="" class="fw-bolder">{{ Auth::user()->name }}</label>
        </div>
        <div class="form-group mb-0 ">
            <label for="">EMAIL:</label>
            <label for="" class="fw-bolder">{{ Auth::user()->email }}</label>
        </div>
        <div class="form-group mb-0 ">
            <label for="">CONTACT NUMBER:</label>
            <label for="" class="fw-bolder">{{ Auth::user()->contact_number }}</label>
        </div>
        </p>
    </div>
@endsection
