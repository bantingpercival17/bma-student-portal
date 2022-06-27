@php
$_title = 'STEP 2: DOCUMENT REQUIREMENTS';
$_applicant_documents = Auth::user()->documents;
@endphp

@section('step-2-dot')
    <div class="timeline-dots timeline-dot1 border-secondary"></div>
    <h5 class="float-left mb-1 text-muted fw-bolder">
        <i>{{ $_title }}</i>
    </h5>
@endsection

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
        Kindly upload your Documents Requirements,
        <a href="{{ route('applicant.document-view') }}"> click here. </a>
    </div>
@endsection
@if (Auth::user()->documents)
    @section('step-2-dot-active-content')
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
            @if ($_document_status)
                <div class="d-inline-block w-100">
                    <p class="mb-0">
                        All the Documents are Verified, and you can proceed to the Entrance Examination
                        Payment.
                    </p>
                </div>
            @else
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
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <span class="text-danger fw-bolder">DISAPPROVED
                                                            DOCUMENT</span>
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
                                                <form action="{{ route('applicant.reupload-documents') }}" method="post"
                                                    enctype="multipart/form-data" class="needs-validation" novalidate>
                                                    <input type="hidden" class="token" name="_token"
                                                        value="{{ csrf_token() }}" />
                                                    <input type="hidden" name="applicant_doc" value="{{ $item->id }}">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <small class="form-label"><b>ATTACH
                                                                        FILES<sup class="text-danger">*</sup></b></small>
                                                                <input class="form-control file-input"
                                                                    id="{{ $item->id }}"
                                                                    data-url="{{ route('applicant.file-upload') }}"
                                                                    data-name="{{ $item->id }}" type="file" required
                                                                    accept="img">
                                                                <input type="hidden" name="document"
                                                                    value="{{ $item->document_id }}">
                                                                <input type="hidden" class="{{ $item->id }}-file"
                                                                    name="file_link" value="">

                                                                <div class="image_frame{{ $item->id }} row mt-2">
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
                                <form action="{{ route('applicant.reupload-documents') }}" method="post"
                                    enctype="multipart/form-data" class="needs-validation" novalidate>
                                    <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}" />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <small class="form-label"><b>ATTACH
                                                        FILES<sup class="text-danger">*</sup></b></small>
                                                <input class="form-control file-input" id="{{ $document->id }}"
                                                    data-url="{{ route('applicant.file-upload') }}"
                                                    data-name="{{ $document->id }}" type="file" required
                                                    accept="img">
                                                <input type="hidden" name="document" value="{{ $document->id }}">
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
        </div>
    @endsection
@endif

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
        <p class="mb-0">
            All the Documents are Verified, and you can proceed to the Entrance Examination
            Payment.
        </p>
    </div>
@endsection
