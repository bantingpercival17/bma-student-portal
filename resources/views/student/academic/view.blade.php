@extends('app')
@php
$_title = 'Academic';
@endphp
@section('page-title', $_title)
@section('content-title', $_title)
@section('beardcrumb-content')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">BMA Student Portal</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $_title }}</li>
    </ol>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">PRE-DEPLOYMENT</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    @if ($_assess && $_document_requirement->count() > 1)
                        <form action="{{ route('onboard.pre_deployment') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">COMPANY NAME</label>
                                <label for="" class="form-control">
                                    {{ $_assess->agency->agency_name }}
                                </label>
                            </div>
                            <div class="">
                                <ul class="list-group">
                                    @if ($_documents->count() > 1)
                                        @foreach ($_documents as $_document)
                                            <li
                                                class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex align-items-center">
                                                    @if ($_student_document = $_document->midshipman_document)

                                                        @if ($_student_document->document_status == 1)
                                                            <button
                                                                class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                                    class="fas fa-check"></i></button>
                                                        @else
                                                            <button
                                                                class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                                    class="fas fa-lock"></i></button>
                                                        @endif
                                                    @endif

                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">
                                                            {{ $_document->document_name }}</h6>
                                                        {{-- <span
                                                        class="text-xs">{{ $_student_certificate ? $_student_certificate->updated_at->format('d F Y ') : '' }}</span> --}}
                                                    </div>
                                                </div>
                                                {{-- <div
                                                class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                                {{ $_student_certificate ? $_student_certificate->certificate_number : '' }}
                                            </div> --}}
                                            </li>
                                        @endforeach

                                    @endif
                                </ul>

                            </div>
                        </form>
                    @else
                        <form action="{{ route('onboard.pre_deployment') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Company Name</label>
                                <select name="_agency" class="form-control">
                                    <option value="">--Select Agency--</option>
                                    @if ($_agency->count() > 0)
                                        @foreach ($_agency as $item)
                                            <option value="{{ $item->id }}">{{ $item->agency_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('_agency')
                                    <label for="example-text-input"
                                        class="form-control-label text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="row">
                                @if ($_documents->count() > 0)
                                    @foreach ($_documents as $_docu)
                                        <div class="form-group col-6">
                                            <label for="example-text-input"
                                                class="form-control-label">{{ $_docu->document_name }}</label>
                                            <input type="hidden"
                                                name="{{ strtolower(str_replace(' ', '_', $_docu->document_name)) }}_id                                                 "
                                                value="{{ $_docu->id }}">
                                            <input type="file"
                                                name="{{ strtolower(str_replace(' ', '_', $_docu->document_name)) }}"
                                                class="form-control">
                                            @error(strtolower(str_replace(' ', '_', $_docu->document_name)))
                                                <label for="example-text-input"
                                                    class="form-control-label text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group float-right">
                                <button class="btn btn-success btn-block" type="submit">SUBMIT</button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-md-5 mt-4">
            <div class="card  mb-4">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md">
                            <h6 class="mb-0">TRAINING & CERTIFICATES</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        @if ($_certificates->count() > 1)
                            @foreach ($_certificates as $_certificate)
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">

                                        @if ($_student_certificate = $_certificate->student_certificate(Auth::user()->student->id))
                                            <button
                                                class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                    class="fas fa-check"></i></button>
                                        @else
                                            <button
                                                class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                    class="fas fa-lock"></i></button>
                                        @endif


                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">{{ $_certificate->training_name }}</h6>
                                            <span
                                                class="text-xs">{{ $_student_certificate ? $_student_certificate->updated_at->format('d F Y ') : '' }}</span>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        {{ $_student_certificate ? $_student_certificate->certificate_number : '' }}
                                    </div>
                                </li>
                            @endforeach

                        @else
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="fas fa-exclamation"></i></button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Training & Certificates</h6>
                                    </div>
                                </div>
                            </li>
                        @endif


                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
