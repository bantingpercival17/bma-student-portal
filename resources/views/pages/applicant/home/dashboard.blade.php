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
                $_document_status = Auth::user()->document_status();
                $_payment = Auth::user()->payment ? (Auth::user()->payment->is_approved == 1 ? true : false) : false;
            @endphp
            <div class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
                <ul class="list-inline p-0 m-0">
                    {{-- Pre-Registration --}}
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
                    {{-- Application Information --}}
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

                            <div class="mb-0">
                                @if ($_applicant)
                                    <div class="row">
                                        <div class="col-md-8">
                                            Successfully Completed your Application Form, now you can proceed to the
                                            Document
                                            Requirements for Uploading the Files.
                                        </div>
                                        <div class="col-md">

                                            <a href="{{ route('applicant.update-information') }}"
                                                class="btn btn-info btn-sm text-white">
                                                Update Application Form
                                            </a>
                                            <a href="{{ route('applicant-form') }}"
                                                class="btn btn-primary btn-sm mt-2">View
                                                Application
                                                Form</a>
                                        </div>
                                    </div>
                                @else
                                    Kindly Fill-up the Form for your Additional Information,<a
                                        href="{{ route('applicant.student-view') }}">click here.</a>
                                @endif
                            </div>
                        </div>
                    </li>
                    {{-- Document Requirements --}}
                    <li>
                        @if ($_applicant)
                            @if (count($_applicant_documents) > 0)
                                @if ($_document_status)
                                    <div class="timeline-dots1 border-secondary text-muted">
                                        <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.091C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.091V7.92C2 4.38 4.28 2 7.67 2ZM11.43 14.99L16.18 10.24C16.52 9.9 16.52 9.35 16.18 9C15.84 8.66 15.28 8.66 14.94 9L10.81 13.13L9.06 11.38C8.72 11.04 8.16 11.04 7.82 11.38C7.48 11.72 7.48 12.27 7.82 12.62L10.2 14.99C10.37 15.16 10.59 15.24 10.81 15.24C11.04 15.24 11.26 15.16 11.43 14.99Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <h5 class="float-left mb-1 text-muted fw-bolder">
                                        STEP 2: Document Requirements</h5>
                                    <div class="d-inline-block w-100">
                                        <p class="mb-0">
                                            All the Documents are Verified, and you can proceed to the Entrance Examination
                                            Payment.
                                        </p>
                                    </div>
                                @else
                                    <div class="timeline-dots1 border-primary text-primary">
                                        <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.09C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.09V7.92C2 4.38 4.28 2 7.67 2ZM7.52 13.2C6.86 13.2 6.32 12.66 6.32 12C6.32 11.34 6.86 10.801 7.52 10.801C8.18 10.801 8.72 11.34 8.72 12C8.72 12.66 8.18 13.2 7.52 13.2ZM10.8 12C10.8 12.66 11.34 13.2 12 13.2C12.66 13.2 13.2 12.66 13.2 12C13.2 11.34 12.66 10.801 12 10.801C11.34 10.801 10.8 11.34 10.8 12ZM15.28 12C15.28 12.66 15.82 13.2 16.48 13.2C17.14 13.2 17.67 12.66 17.67 12C17.67 11.34 17.14 10.801 16.48 10.801C15.82 10.801 15.28 11.34 15.28 12Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </div>
                                    <h5 class="float-left mb-1 text-primary fw-bolder">
                                        STEP 2: Document Requirements</h5>
                                    <div class="d-inline-block w-100">
                                        <div class="row">
                                            @foreach ($_documents as $key => $document)
                                                @foreach ($_applicant_documents as $item)
                                                    @if ($document->id == $item->document_id)
                                                        <div class="col-md-4 mt-2 ">
                                                            <h5 class="text-muted fw-bolder">
                                                                {{ $document->document_name }}
                                                            </h5>
                                                            @php
                                                                //$index = array_search($item->journal_type, $_narative_details);
                                                                unset($_documents[$key]);
                                                            @endphp
                                                            @if ($item->is_approved === null)
                                                                <span class="text-info">This Document is under
                                                                    verification</span>
                                                                <a class="btn-form-document col" data-bs-toggle="modal"
                                                                    data-bs-target=".document-view-modal"
                                                                    data-document-url="{{ json_decode($item->file_links)[0] }}">
                                                                    view document
                                                                </a>
                                                            @else
                                                                @if ($item->is_approved === 1)
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <span class="text-primary">APPROVED
                                                                                DOCUMENT</span>
                                                                        </div>
                                                                        <div class="col-md">
                                                                            <div class="form-group">
                                                                                <small for=""
                                                                                    class="form-label">VERIFIED
                                                                                    BY:</small>
                                                                                <span
                                                                                    class="text-muted fw-bolder">{{ $item->staff->user->name }}</span><br>
                                                                                <small for=""
                                                                                    class="form-label">VERIFIED
                                                                                    DATE:</small>
                                                                                <span
                                                                                    class="text-muted fw-bolder">{{ $item->created_at->format('F d, Y') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <span class="text-danger fw-bolder">DISAPPROVED
                                                                                DOCUMENT</span>
                                                                        </div>
                                                                        <div class="col-md">
                                                                            <div class="form-group">
                                                                                <small for=""
                                                                                    class="form-label">VERIFIED
                                                                                    BY:</small>
                                                                                <span
                                                                                    class="text-muted fw-bolder">{{ $item->staff->user->name }}</span><br>
                                                                                <small for=""
                                                                                    class="form-label">VERIFIED
                                                                                    DATE:</small>
                                                                                <span
                                                                                    class="text-muted fw-bolder">{{ $item->created_at->format('F d, Y') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('applicant.reupload-documents') }}"
                                                                        method="post" enctype="multipart/form-data"
                                                                        class="needs-validation" novalidate>
                                                                        <input type="hidden" class="token"
                                                                            name="_token" value="{{ csrf_token() }}" />
                                                                        <input type="hidden" name="applicant_doc"
                                                                            value="{{ $item->id }}">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <small class="form-label"><b>ATTACH
                                                                                            FILES<sup
                                                                                                class="text-danger">*</sup></b></small>
                                                                                    <input class="form-control file-input"
                                                                                        id="{{ $item->id }}"
                                                                                        data-url="{{ route('applicant.file-upload') }}"
                                                                                        data-name="{{ $item->id }}"
                                                                                        type="file" required accept="img">
                                                                                    <input type="hidden" name="document"
                                                                                        value="{{ $item->document_id }}">
                                                                                    <input type="hidden"
                                                                                        class="{{ $item->id }}-file"
                                                                                        name="file_link" value="">

                                                                                    <div
                                                                                        class="image_frame{{ $item->id }} row mt-2">
                                                                                    </div>
                                                                                    <div class="invalid-feedback">
                                                                                        Please attach a files for
                                                                                        {{ $item->document_name }}.
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn btn-primary btn-sm w-100 ms-2">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                    {{-- Reupload files --}}
                                                                @endif
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach

                                            @foreach ($_documents as $key => $document)
                                                <div class="col-md-4 mt-2 ">
                                                    <h5 class="text-muted fw-bolder">
                                                        {{ $document->document_name }}
                                                    </h5>
                                                    {{-- <span class="text-danger">Without Documents</span><br> --}}
                                                    <form action="{{ route('applicant.reupload-documents') }}"
                                                        method="post" enctype="multipart/form-data" class="needs-validation"
                                                        novalidate>
                                                        <input type="hidden" class="token" name="_token"
                                                            value="{{ csrf_token() }}" />
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <small class="form-label"><b>ATTACH
                                                                            FILES<sup
                                                                                class="text-danger">*</sup></b></small>
                                                                    <input class="form-control file-input"
                                                                        id="{{ $document->id }}"
                                                                        data-url="{{ route('applicant.file-upload') }}"
                                                                        data-name="{{ $document->id }}" type="file"
                                                                        required accept="img">
                                                                    <input type="hidden" name="document"
                                                                        value="{{ $document->id }}">
                                                                    <input type="hidden" class="{{ $document->id }}-file"
                                                                        name="file_link" value="">

                                                                    <div class="image_frame{{ $document->id }} row mt-2">
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        Please attach a files for
                                                                        {{ $document->document_name }}.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm w-100 ms-2 btn-file-submit-{{ $document->id }}"
                                                                disabled>Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endforeach



                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="timeline-dots1 border-primary text-primary">
                                    <svg width="20" viewBox="0 2 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.67 2H16.34C19.73 2 22 4.38 22 7.92V16.09C22 19.62 19.73 22 16.34 22H7.67C4.28 22 2 19.62 2 16.09V7.92C2 4.38 4.28 2 7.67 2ZM7.52 13.2C6.86 13.2 6.32 12.66 6.32 12C6.32 11.34 6.86 10.801 7.52 10.801C8.18 10.801 8.72 11.34 8.72 12C8.72 12.66 8.18 13.2 7.52 13.2ZM10.8 12C10.8 12.66 11.34 13.2 12 13.2C12.66 13.2 13.2 12.66 13.2 12C13.2 11.34 12.66 10.801 12 10.801C11.34 10.801 10.8 11.34 10.8 12ZM15.28 12C15.28 12.66 15.82 13.2 16.48 13.2C17.14 13.2 17.67 12.66 17.67 12C17.67 11.34 17.14 10.801 16.48 10.801C15.82 10.801 15.28 11.34 15.28 12Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </div>
                                <h5 class="float-left mb-1 text-primary fw-bolder">
                                    STEP 2: Document Requirements</h5>
                                <div class="d-inline-block w-100">
                                    Kindly upload your Documents Requirements,
                                    <a href="{{ route('applicant.document-view') }}"> click here. </a>
                                </div>
                            @endif
                        @else
                            <div class="timeline-dots timeline-dot1 border-secondary  text-muted"></div>
                            <h5 class="float-left mb-1 text-muted fw-bolder">
                                <i> STEP 2: Document Requirements</i>
                            </h5>
                        @endif
                    </li>
                    {{-- Entrance Examination Payment --}}
                    <li>
                        @include('pages.applicant.components.payment')
                        {{-- Applicant Done --}}
                        @if ($_applicant && $_document_status)
                            {{-- Document Verification --}}
                            @if (!Auth::user()->payment)
                                @yield('step-3-dot-active')
                                @yield('payment-view')
                            @else
                                @if (Auth::user()->payment->is_approved != 1)
                                    @yield('step-3-dot-active')
                                    @yield('payment-transaction-view')
                                @else
                                    @yield('step-3-dot-done')
                                @endif

                            @endif
                        @else
                            @yield('step-3-dot')
                        @endif

                    </li>
                    <li>
                        @include('pages.applicant.components.entrance-examination')
                        @if ($_applicant && $_document_status && $_payment)
                            @if (Auth::user()->examination)
                                @yield('step-4-dot-done')
                            @else
                                @yield('step-4-dot-active')
                                @yield('step-4-active-content')
                            @endif
                        @else
                            @yield('step-4-dot')
                        @endif
                    </li>
                    <li>
                        @include('pages.applicant.components.virtual-briefing')
                        @if ($_applicant && $_document_status && $_payment)
                            @if (Auth::user()->examination)
                                @if (Auth::user()->examination->is_finish === 1)
                                    @if (Auth::user()->examination->result())
                                        @if (Auth::user()->virtual_briefing)
                                            @yield('step-5-dot-done')
                                            @yield('step-5-done-content')
                                        @else
                                            @yield('step-5-dot-active')
                                            @yield('step-5-active-content')
                                        @endif
                                    @else
                                        @yield('step-5-dot-done')
                                    @endif
                                @else
                                    @yield('step-5-dot')
                                @endif
                            @else
                                @yield('step-5-dot')
                            @endif
                        @else
                            @yield('step-5-dot')
                        @endif
                    </li>
                    <li>
                        @include('pages.applicant.components.medical-examination')
                        @if ($_applicant && $_document_status && $_payment)
                            @if (Auth::user()->examination)
                                @if (Auth::user()->examination->is_finish === 1)
                                    @if (Auth::user()->examination->result())
                                        @if (Auth::user()->virtual_briefing)
                                            @yield('step-6-dot-active')
                                            @yield('step-6-active-content')
                                        @else
                                            @yield('step-6-dot')
                                        @endif
                                    @else
                                        @yield('step-6-dot')
                                    @endif
                                @else
                                    @yield('step-6-dot')
                                @endif
                            @else
                                @yield('step-6-dot')
                            @endif
                        @else
                            @yield('step-6-dot')
                        @endif
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

@endsection
@section('js')
    <script src="{{ asset('resources/js/plugins/file-uploads.js') }}"></script>
    <script src="{{ asset('resources/js/plugins/custom-document-viewer.js') }}"></script>
@endsection
