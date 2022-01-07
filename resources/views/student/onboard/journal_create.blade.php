@extends('app-main')
@php
$_title = 'Create Shipboard Journal';
@endphp
@section('page-title', $_title)
@section('content-title', $_title)
@section('beardcrumb-content')
    <li class="breadcrumb-item">
        <a href="{{ route('on-board') }}">
            @include('layouts.icon-main')
            @yield('icon-job')
            On Board Training
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ $_title }}</li>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <label for="" class="card-title h5"><b>Create Narative Report</b></label>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('onboard.store-journal') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <small class="form-label"><b>MONTHLY REPORT</b></small>
                            <select class="form-select" data-trigger="" name="_month">
                                <option selected="" disabled="">Choose Month</option>
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}" {{ old('_month') == $month ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $month)) }}</option>
                                @endfor
                            </select>
                            @error('_month')

                                <small class="text-danger"><b>{{ $message }}</b></small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <p class="h6"><b>TRB DOCUMENTS</b></p>
                            <div class="form-group">
                                <small class="form-label"><b>REMARKS</b></small>
                                <textarea name="_trb_remark" class="form-control" cols="30"
                                    rows="5">{{ old('_trb_remark') }}</textarea>
                                @error('_trb_remark')
                                    <small class="text-danger"><b>{{ $message }}</b></small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <small class="form-label"><b>ATTACH TRB FILES</b></small>
                                <input class="form-control" type="file" id="customFile2" name="_trb_documents[]"
                                    value="{{ old('_trb_documents') }}" multiple>
                                @error('_trb_documents')
                                    <small class="text-danger"><b>{{ $message }}</b></small>
                                @enderror
                            </div>
                        </div>
                        <div class="formd-group">
                            <p class="h6"><b>JOURNAL DOCUMENTS</b></p>
                            <div class="form-group">
                                <small class="form-label"><b>REMARKS</b></small>
                                <textarea name="_journal_remark" class="form-control" cols="30"
                                    rows="5">{{ old('_journal_remark') }}</textarea>
                                @error('_journal_remark')
                                    <small class="text-danger"><b>{{ $message }}</b></small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <small class="form-label"><b>ATTACH JOURNAL FILES</b></small>
                                <input class="form-control" type="file" id="customFile2" name="_journal_documents[]"
                                    value="{{ old('_journal_documents') }}" multiple>
                                @error('_journal_documents')
                                    <small class="text-danger"><b>{{ $message }}</b></small>
                                @enderror
                            </div>
                        </div>
                        <div class="formd-group">
                            <p class="h6"><b>CREW LIST</b></p>
                            <div class="form-group">
                                <small class="form-label"><b>ATTACH FILES</b></small>
                                <input class="form-control" type="file" id="customFile2" name="_crew_list_documents[]"
                                    value="{{ old('_crew_list_documents') }}" multiple>
                                @error('_crew_list_documents')
                                    <small class="text-danger"><b>{{ $message }}</b></small>
                                @enderror
                            </div>
                        </div>
                        <div class="formd-group">
                            <p class="h6"><b>CREW LIST</b></p>
                            <div class="form-group">
                                <small class="form-label"><b>ATTACH FILES</b></small>
                                <input class="form-control" type="file" id="customFile2" name="_crew_list_documents[]"
                                    value="{{ old('_crew_list_documents') }}" multiple>
                                @error('_crew_list_documents')
                                    <small class="text-danger"><b>{{ $message }}</b></small>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Submit</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-4">

        </div>
    </div>
@endsection
