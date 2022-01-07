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
        <div class="swiper swiper-container mySwiper position-relative">
            @if ($_count = count(Auth::user()->student->shipboard_journal) > 3)
                <div class="swiper-button-next1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="0 0 33 34" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.4993 1.58398C7.98601 1.58398 1.08268 8.48565 1.08268 17.0007C1.08268 25.514 7.98601 32.4173 16.4993 32.4173C25.0127 32.4173 31.916 25.514 31.916 17.0007C31.916 8.48565 25.0127 1.58398 16.4993 1.58398Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M18.9023 11.2148L13.0923 16.9998L18.9023 22.7848" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            @endif

            @include('layouts.icon-main')
            <div class="swiper-wrapper row-cols-2 row-cols-lg-5 list-inline">

                <div class="swiper-slide">
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
                </div>
                @if (count($_journal) > 0)
                    @foreach ($_journal as $_journal)
                        <div class="text-center">
                            <div class="card-body ">
                                <a href="{{ route('onboard.view-journal') }}?_j={{base64_encode($_journal->month)}}">
                                    <i class="icon text-muted">
                                        @yield('icon-document')
                                    </i>

                                    <h5 class="text-muted mt-3">{{ date('F - Y', strtotime($_journal->month)) }}
                                    </h5>
                                </a>

                            </div>
                        </div>
                    @endforeach

                @endif
            </div>
            @if ($_count)
                <div class="swiper-button-prev1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="33" height="34" viewBox="0 0 33 34" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.5007 32.416C25.014 32.416 31.9173 25.5143 31.9173 16.9993C31.9173 8.48602 25.014 1.58268 16.5007 1.58268C7.98732 1.58268 1.08398 8.48602 1.08398 16.9993C1.08398 25.5143 7.98732 32.416 16.5007 32.416Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.0977 22.7852L19.9077 17.0002L14.0977 11.2152" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            @endif

        </div>
    @endif
    <div class="row">
        <div class="col-md-7">
            @if ($_assess || ($_shipboard_training = Auth::user()->student->shipboard_training))
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

                                            @yield( $_student_certificate ? 'icon-verified' : 'icon-not-verified')
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

                                        @yield( 'icon-not-verified')
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
