@extends('layouts.applicant-template')
@php
$_title = 'Overview';
@endphp
@section('page-title', $_title)
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
    <div class="card">
        <div class="card-header d-flex justify-content-between border-bottom-0 pb-0">
            <div class="header-title">
                <h4 class="card-title fw-bolder">Entrance Examination Overview</h4>
            </div>
        </div>
        <div class="card-body">
            @php
                $_applicant = Auth::user()->applicant;
                $_applicant_documents = Auth::user()->documents;
            @endphp
            <div class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
                <ul class="list-inline p-0 m-0">
                    <li>
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
                    </li>
                    <li>
                        <div
                            class="timeline-dots1 {{ $_applicant ? 'border-secondary  text-muted' : 'border-primary  text-primary' }}">
                            @if ($_applicant)
                                <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.091C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.091V7.92C2 4.38 4.28 2 7.67 2ZM11.43 14.99L16.18 10.24C16.52 9.9 16.52 9.35 16.18 9C15.84 8.66 15.28 8.66 14.94 9L10.81 13.13L9.06 11.38C8.72 11.04 8.16 11.04 7.82 11.38C7.48 11.72 7.48 12.27 7.82 12.62L10.2 14.99C10.37 15.16 10.59 15.24 10.81 15.24C11.04 15.24 11.26 15.16 11.43 14.99Z"
                                        fill="currentColor"></path>
                                </svg>
                            @else
                                <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.09C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.09V7.92C2 4.38 4.28 2 7.67 2ZM7.52 13.2C6.86 13.2 6.32 12.66 6.32 12C6.32 11.34 6.86 10.801 7.52 10.801C8.18 10.801 8.72 11.34 8.72 12C8.72 12.66 8.18 13.2 7.52 13.2ZM10.8 12C10.8 12.66 11.34 13.2 12 13.2C12.66 13.2 13.2 12.66 13.2 12C13.2 11.34 12.66 10.801 12 10.801C11.34 10.801 10.8 11.34 10.8 12ZM15.28 12C15.28 12.66 15.82 13.2 16.48 13.2C17.14 13.2 17.67 12.66 17.67 12C17.67 11.34 17.14 10.801 16.48 10.801C15.82 10.801 15.28 11.34 15.28 12Z"
                                        fill="currentColor"></path>
                                </svg>
                            @endif
                        </div>
                        <h5 class="float-left {{ $_applicant ? 'text-muted' : 'text-primary' }} mb-1 fw-bolder">
                            STEP 1: Applicant Information</h5>
                        <div class="d-inline-block w-100">

                            <p class="mb-0">
                                @if ($_applicant)
                                    Successfully Complete your Application Form, now you can proceed to the Document
                                    Requirements for Uploading the Files.
                                    <a href="" class="btn btn-primary btn-sm">View Applicantion Form</a>
                                @else
                                    Kindly Fill-up the Form for your Additional Infromation,<a
                                        href="{{ route('applicant.student-view') }}">click here.</a>
                                @endif
                            </p>
                        </div>
                    </li>
                    <li>
                        @if ($_applicant)
                            <div class="timeline-dots1 border-primary  text-primary">
                                {{-- <div
                            class="timeline-dots1 {{ count($_applicant_documents) ? 'border-secondary  text-muted' : 'border-primary  text-primary' }}"> --}}

                                @if (count($_applicant_documents) > 0)
                                    <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.09C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.09V7.92C2 4.38 4.28 2 7.67 2ZM7.52 13.2C6.86 13.2 6.32 12.66 6.32 12C6.32 11.34 6.86 10.801 7.52 10.801C8.18 10.801 8.72 11.34 8.72 12C8.72 12.66 8.18 13.2 7.52 13.2ZM10.8 12C10.8 12.66 11.34 13.2 12 13.2C12.66 13.2 13.2 12.66 13.2 12C13.2 11.34 12.66 10.801 12 10.801C11.34 10.801 10.8 11.34 10.8 12ZM15.28 12C15.28 12.66 15.82 13.2 16.48 13.2C17.14 13.2 17.67 12.66 17.67 12C17.67 11.34 17.14 10.801 16.48 10.801C15.82 10.801 15.28 11.34 15.28 12Z"
                                            fill="currentColor"></path>
                                    </svg>
                                @else
                                    <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.09C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.09V7.92C2 4.38 4.28 2 7.67 2ZM7.52 13.2C6.86 13.2 6.32 12.66 6.32 12C6.32 11.34 6.86 10.801 7.52 10.801C8.18 10.801 8.72 11.34 8.72 12C8.72 12.66 8.18 13.2 7.52 13.2ZM10.8 12C10.8 12.66 11.34 13.2 12 13.2C12.66 13.2 13.2 12.66 13.2 12C13.2 11.34 12.66 10.801 12 10.801C11.34 10.801 10.8 11.34 10.8 12ZM15.28 12C15.28 12.66 15.82 13.2 16.48 13.2C17.14 13.2 17.67 12.66 17.67 12C17.67 11.34 17.14 10.801 16.48 10.801C15.82 10.801 15.28 11.34 15.28 12Z"
                                            fill="currentColor"></path>
                                    </svg>
                                @endif
                            </div>
                        @else
                            <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
                        @endif

                        <h5
                            class="float-left mb-1 {{ $_applicant ? ($_applicant_documents ? 'text-primary' : 'text-info') : 'text-muted' }} fw-bolder">
                            STEP 2: Document
                            Requirements</h5>
                        <div class="d-inline-block w-100">
                            @if ($_applicant)
                                @if (count($_applicant_documents) > 0)
                                    <div class="row">
                                        @foreach ($_applicant_documents as $item)
                                            <div class="col-md-4 mt-2">
                                                <h5 class="text-muted fw-bolder">{{ $item->document->document_name }}
                                                </h5>
                                                @if ($item->is_approved === null)
                                                    <span class="text-info">This Document is under verification</span>
                                                    <a class="btn-form-document col" data-bs-toggle="modal"
                                                        data-bs-target=".document-view-modal"
                                                        data-document-url="{{ json_decode($item->file_links)[0] }}">
                                                        view document
                                                    </a>
                                                @else
                                                    @if ($item->is_approved === 1)
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span class="text-primary">APPROVED DOCUMENT</span>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="form-group">
                                                                    <small for="" class="form-label">VERIFIED
                                                                        BY:</small>
                                                                    <span
                                                                        class="text-muted fw-bolder">{{ $item->staff->user->name }}</span><br>
                                                                    <small for="" class="form-label">VERIFIED
                                                                        DATE:</small>
                                                                    <span
                                                                        class="text-muted fw-bolder">{{ $item->created_at->format('F d, Y') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        {{-- Reupload files --}}
                                                    @endif
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    Kindly upload your Documents Requirements,<a
                                        href="{{ route('applicant.document-view') }}"> click here.</a>
                                @endif
                            @endif

                        </div>
                    </li>
                    <li>
                        <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
                        <h5
                            class="float-left mb-1 {{ $_applicant ? ($_applicant_documents ? 'text-muted' : 'text-info') : 'text-muted' }} fw-bolder">
                            <i> STEP 3 Entrance Examination Payment</i>
                        </h5>
                    </li>
                    <li>
                        <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
                        <h5
                            class="float-left mb-1 {{ $_applicant ? ($_applicant_documents ? 'text-muted' : 'text-info') : 'text-muted' }} fw-bolder">
                            <i> STEP 4 Entrance Examination Schedule</i>
                        </h5>
                    </li>
                    <li>
                        <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
                        <h5
                            class="float-left mb-1 {{ $_applicant ? ($_applicant_documents ? 'text-muted' : 'text-info') : 'text-muted' }} fw-bolder">
                            <i> STEP 5 Passing Applicant Briefing</i>
                        </h5>
                    </li>
                    <li>
                        <div class="timeline-dots timeline-dot1 border-secondary  text-success"></div>
                        <h5
                            class="float-left mb-1 {{ $_applicant ? ($_applicant_documents ? 'text-muted' : 'text-info') : 'text-muted' }} fw-bolder">
                            <i> STEP 6 Medical</i>
                        </h5>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="modal fade document-view-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Document Review</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <iframe class="iframe-container form-view iframe-placeholder" width="100%" height="600px">
                </iframe>
            </div>
        </div>
    </div>
@section('js')
    <script src="{{ asset('resources/js/plugins/custom-document-viewer.js') }}"></script>
@endsection
@endsection
