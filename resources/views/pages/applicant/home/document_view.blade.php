@extends('layouts.applicant-template')
@php
$_title = 'Applicant Document Requirements';
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
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="header-title">
                    <h5 class="mb-1"><b>DOCUMENT REQUIREMENTS</b></h5>
                    <span class="text-muted">Kindly Attach the needed Requirements for the Entrance
                        Examination.</span>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('applicant.store-documents') }}" method="post" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}" />

                    <div class="row">
                        @foreach ($_documents as $document)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label fw-bolder">{{ $document->document_name }}</div>
                                    <small class="form-label"><b>ATTACH FILES<sup
                                                class="text-danger">*</sup></b></small>
                                    <input class="form-control file-input" id="{{ $document->id }}"
                                        data-url="{{ route('applicant.file-upload') }}" data-name="{{ $document->id }}"
                                        type="file" required accept="img">
                                    <input type="hidden" name="document[]" value="{{ $document->id }}">
                                    <input type="hidden" class="{{ $document->id }}-file" name="file_url[]" value="">

                                    <div class="image_frame{{ $document->id }} row mt-2">
                                    </div>
                                    <div class="invalid-feedback">
                                        Please attach a files for {{ $document->document_name }}.
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@section('js')
    <script src="{{ asset('resources/js/plugins/file-uploads.js') }}"></script>
@endsection
@endsection
