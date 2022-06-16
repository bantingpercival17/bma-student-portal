@extends('layouts.applicant-template')
@php
$_title = 'Enrollment Overview';
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
                <h4 class="card-title fw-bolder text-primary">Enrollment Overview</h4>
            </div>
        </div>
        <div class="card-body">
            @include('pages.applicant.enrollment.components.registrartion')
            @include('pages.applicant.enrollment.components.enrollment_assessment')
            @include('pages.applicant.enrollment.components.payment_mode')
            @include('pages.applicant.enrollment.components.payment_assessment')
            @include('pages.applicant.enrollment.components.payment_transaction')
            <div class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
                <ul class="list-inline p-0 m-0">
                    @if (Auth::user()->enrollment_registrartion())
                        <li>@yield('step-1-dot-done')</li>
                        <li> @yield('step-2-dot-active')</li>
                        <li> @yield('step-3-dot')</li>
                        <li> @yield('step-4-dot')</li>
                        <li> @yield('step-5-dot')</li>
                    @else
                        <li>@yield('step-1-dot-active')</li>
                        <li> @yield('step-2-dot')</li>
                        <li> @yield('step-3-dot')</li>
                        <li> @yield('step-4-dot')</li>
                        <li> @yield('step-5-dot')</li>
                    @endif



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
