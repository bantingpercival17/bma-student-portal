@extends('app-main')
@php
$_title = 'Create Narative Report';
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

                    <form action="{{ route('onboard.store-journal') }}" method="post" enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                        {{-- @csrf --}}
                        <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <small class="form-label"><b>MONTHLY REPORT <sup class="text-danger">*</sup></b></small>
                            <input class="form-control" type="month" name="_month">
                            @error('_month')
                                <small class="text-danger"><b>{{ $message }}</b></small>
                            @enderror
                            <div class="invalid-feedback">
                                Please select a Month .
                            </div>
                        </div>
                        @php
                            $_narative_details = [['Training Record Book', '_trb_documents', '_trb_remark'], ['Daily Journal', '_journal_documents', '_journal_remark'], ['Crew List', '_crew_list'], ["Master's Declaration of Safe Departure", '_mdsd'], ['Picture while at work', '_while_at_work']];
                        @endphp
                        @foreach ($_narative_details as $_name)
                            {{-- <div class="formd-group">
                                <p class="h6">
                                    <b>{{ strtoupper($_name[0]) }}</b>
                                </p>
                                <div class="form-group">
                                    <small class="form-label"><b>ATTACH FILES <sup
                                                class="text-danger">*</sup></b></small>
                                    <input class="form-control" type="file" name="{{ $_name[1] }}[]"
                                        value="{{ old($_name[1]) }}" multiple required>
                                    @error($_name[1])
                                        <small class="text-danger"><b>{{ $message }}</b></small>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Please attach a files for {{ ucwords($_name[0]) }} .
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <p class="h6">
                                    <b>{{ strtoupper($_name[0]) }}</b>
                                </p>
                                @if (count($_name) > 2)
                                    <div class="form-group">
                                        <small class="form-label"><b>REMARKS<sup
                                                    class="text-danger">*</sup></b></small>
                                        <textarea name="{{ $_name[2] }}" class="form-control" cols="30" rows="3"
                                            required>{{ old($_name[2]) }}</textarea>
                                        @error($_name[2])
                                            <small class="text-danger"><b>{{ $message }}</b></small>
                                        @enderror
                                    </div>
                                @endif

                                <div class="form-group">
                                    <small class="form-label"><b>ATTACH TRB FILES<sup
                                                class="text-danger">*</sup></b></small>
                                    <input class="form-control file-input" id="{{ $_name[1] }}"
                                        data-name={{ $_name[1] }} type="file" multiple required accept="img">
                                    <input type="hidden" class="{{ $_name[1] }}-file" name="{{ $_name[1] }}"
                                        value="{{ old($_name[1]) }}">

                                    <div class="image_frame{{ $_name[1] }} row mt-2">
                                    </div>
                                    @error($_name[1])
                                        <small class="text-danger"><b>{{ $message }}</b></small>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Please attach a files for {{ ucwords($_name[0]) }} .
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach

                        <button class="btn btn-primary w-100" type="submit">Submit</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-4">

        </div>
    </div>

@section('js')
    <script src="{{ asset('resources/js/plugins/file-uploads.js') }}"></script>
@endsection
@endsection
