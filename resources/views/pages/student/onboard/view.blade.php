@extends('app-main')
@php
$_title = 'On Board Training';
@endphp
@section('page-title', $_title)
@section('content-title', $_title)
@section('beardcrumb-content')
    <li class="breadcrumb-item active" aria-current="page">
        @include('layouts.icon-main')
        @yield('icon-job')
        {{ $_title }}
    </li>
@endsection
@section('page-content')
    @if (Auth::user()->student->shipboard_training)
        <div class="header-title d-flex justify-content-between">
            <h5 class=" fw-bolder">NARATIVE REPORT</h5>
        </div>
        <div class="table-responsive">
            <div class="header-title d-flex justify-content-between">
                <label for="" class="badge bg-info fw-bolder">APPROVED NARATIVE REPORT</label>
                <label for="" class="badge bg-danger fw-bolder">DISAPPROVED NARATIVE REPORT</label>
                <label for="" class="badge bg-warning fw-bolder">APPROVED NARATIVE REPORT</label>
            </div>
            <table id="basic-table" class="table table-striped mb-0" role="grid">
                <tbody>
                    <tr>
                        <td>
                            <div class="text-center">
                                <div class="card-body ">
                                    <a href="{{ route('onboard.journal') }}">
                                        <i class="icon text-primary">
                                            @yield('icon-add')
                                        </i>

                                        <h5 class="text-muted mt-3">Add Narative Report</h5>
                                    </a>

                                </div>
                            </div>
                        </td>
                        @if (count($_journal) > 0)
                            @foreach ($_journal as $_journal_item)
                                <th>
                                    <div class="text-center">
                                        <div class="card-body ">
                                            <a
                                                href="{{ route('onboard.view-journal') }}?_j={{ base64_encode($_journal_item->month) }}">
                                                <i class="icon text-muted">
                                                    @yield('icon-document')
                                                </i>

                                                <h5 class="text-muted mt-3">
                                                    {{ date('F - Y', strtotime($_journal_item->month)) }}
                                                </h5>
                                            </a>

                                        </div>
                                    </div>
                                </th>
                            @endforeach
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
    <div class="row mt-4">
        <div class="col-md-7">

            @if ($_shipboard_training = Auth::user()->student->shipboard_training)

                @if (count($_journal) > 20)
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <span class="card-title h5">ASSESSMENTS</span>
                            </div>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <p class="text-primary fw-bolder h5">Online Assessment</p>
                            <p class="m-0"> <span class="fw-bolder m-0">INSTRUCTION</span></p>
                            <p class="m-0">1. Ensure that you have a strong internet connection.</p>
                            <p class="m-0">2. Once you are logged in, read carefully and understand the guidelines prior
                                to
                                and
                                after the Examination</p>
                            <p class="m-0">3. Upon completion of the Examination, click the Submit or Back button at the
                                system.</p>
                            <p class="m-0">4.Once you enter the Examination Code it will be start your Examination
                            </p>
                            <p>5.We recommend using Laptop/Desktop running atleast Windows 7 or higher to take the
                                examination.
                                We also recommend to use Google Chrome as browser in taking the examination.</p>
                            <br>

                            <div>
                                <p class="">EXAMINATION CATEGORIES</p>
                                <span class="">
                                    <!-- GENERAL QUESTION --> TRB - 20 items
                                </span><br>
                                <span class="">GENERAL QUESTION - 10 items</span><br>
                                <span class="">{{ $_shipboard_training->vessel_type }}- 10 items</span><br><br>
                            </div>
                            <form action="{{ route('onboard.assessment') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <small class="fw-bolder">EXAMINATION CODE</small> <br>
                                    <label for="" class="form-label text-primary fw-bolder">
                                        CODE-XJOEIJKDK
                                    </label>
                                    <div class="row">
                                        <div class="col-md">
                                            <input type="text" class="form-control" name="exam_code"
                                                placeholder="Enter Examination Code">
                                            @error('exam_code')
                                                <span class="mt-2 badge bg-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md">
                                            <button type="submit" class="btn btn-primary ">Take Examination</button>
                                        </div>

                                    </div>
                                    @if (Session::has('error'))
                                        <span class="mt-2 badge bg-danger">{{ Session::get('error') }}</span>
                                    @endif
                                </div>

                            </form>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <span class="card-title h5">SHIPBOARD INFORMATION</span>
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        @if ($_shipboard_training)
                            <form>
                                <div class="row">
                                    <div class="form-group col-md">
                                        <label for="" class="form-label"><small>OBT BATCH</small></label>
                                        <br>
                                        <label
                                            class="form-control text-primary"><b>{{ $_shipboard_training->sbt_batch }}</b></label>
                                        <span class="mb-1"></span>
                                        {{-- <label for="" class="display-6">{{ $_shipboard_training->sbt_batch }}</label> --}}
                                    </div>
                                    <div class="form-group col-md">
                                        <label for="" class="form-label"><small>STATUS</small></label>
                                        <br>
                                        <label for="" class="form-control text-primary">
                                            <b> {{ strtoupper($_shipboard_training->shipboard_status) }} </b>

                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label-sm"><small>COMPANY NAME</small></label>
                                    <label for=""
                                        class="form-control text-primary"><b>{{ $_shipboard_training->company_name }}</b></label>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md">
                                        <label for="" class="form-label"><small>NAME OF SHIPPING</small></label>
                                        <label for="" class="form-control text-primary">
                                            <b>{{ $_shipboard_training->vessel_name }}</b>
                                        </label>
                                    </div>
                                    <div class="form-group col-md">
                                        <label for="" class="form-label"><small>VESSEL TYPE</small></label>
                                        <label for=""
                                            class="form-control text-primary"><b>{{ $_shipboard_training->vessel_type }}</b></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <label for="" class="form-label"><small>SEA EXPERIENCE</small></label>
                                        <label for=""
                                            class="form-control text-primary"><b>{{ strtoupper($_shipboard_training->shipping_company) }}</b></label>
                                    </div>
                                    <div class="form-group col-md">
                                        <label for="" class="form-label"><small>DATE OF EMBARKED</small></label>
                                        <label for=""
                                            class="form-control text-primary"><b>{{ $_shipboard_training->embarked }}</b></label>
                                    </div>
                                    @if ($_shipboard_training->shipboard_status != 'on going')
                                        <div class="form-group col-md">
                                            <label for="" class="form-label"><small>DATE OF
                                                    DISEMBARKED</small></label>
                                            <label for=""
                                                class="form-control text-primary"><b>{{ $_shipboard_training->disembarked }}</b></label>
                                        </div>
                                    @endif

                                </div>

                                {{-- 18194 --}}
                            </form>
                        @else
                        @endif
                    </div>
                </div>
            @endif


            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <span class="card-title h5">PRE-DEPLOYMENT</span>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    @if ($_assess && $_document_requirement->count() > 1)
                        <form action="{{ route('onboard.pre_deployment') }}" method="post"
                            enctype="multipart/form-data">
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
                        <form action="{{ route('onboard.pre_deployment') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="exampleFormControlSelect1">COMPANY NAME</label>
                                <select class="form-select" id="exampleFormControlSelect1" name="_agency">
                                    <option selected="" disabled="">Choose Agency</option>
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
                                <button class="btn btn-primary w-100" type="submit">SUBMIT</button>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <span class="card-title h5">TRAINING & CERTIFICATES</span>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-inline m-0 p-0">
                        @include('layouts.icon-main')
                        @if ($_certificates->count() > 1)
                            @foreach ($_certificates as $_certificate)
                                <li class="d-flex mb-4 align-items-center">
                                    @php
                                        $_student_certificate = $_certificate->student_certificate(Auth::user()->student->id);
                                    @endphp
                                    <div class="{{-- bg-soft-primary --}} rounded-pill">
                                        <i class="icon {{ $_student_certificate ? 'text-primary' : '' }}">

                                            @yield($_student_certificate ? 'icon-verified' : 'icon-not-verified')
                                        </i>
                                    </div>
                                    <div class="ms-3 flex-grow-1">
                                        <h6>{{ $_certificate->training_name }}</h6>
                                        <p class="mb-0">
                                            {{ $_student_certificate ? $_student_certificate->updated_at->format('d F Y ') : '' }}
                                            <span
                                                class="text-primary">{{ $_student_certificate ? ' | ' . $_student_certificate->certificate_number : '' }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="d-flex mb-4 align-items-center">

                                <div class="img-fluid bg-soft-warning rounded-pill">
                                    <i class="icon">

                                        @yield('icon-not-verified')
                                    </i>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <h6>TRAINING & CERTIFICATES</h6>
                                    <p class="mb-0">4 mutual friends</p>
                                </div>
                            </li>
                        @endif

                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
