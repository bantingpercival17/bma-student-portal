@extends('layouts.applicant-template')
@php
$_title = 'Overview';
@endphp
@section('page-title', $_title)
@section('beardcrumb-content')
    <li class="breadcrumb-item active" aria-current="page">
        <svg width="14" height="14" class="me-2" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            @include('pages.applicant.home.components.pre-registration')
            @include('pages.applicant.home.components.application_form')
            @include('pages.applicant.home.components.documents')
            @include('pages.applicant.home.components.examination-payment')
            @include('pages.applicant.home.components.examination')
            @include('pages.applicant.home.components.virtual-briefing')
            @include('pages.applicant.home.components.medical-examination')
            <div class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
                <ul class="list-inline p-0 m-0">
                    {{-- Pre-Registration --}}
                    <li>@yield('step-0-dot-done')</li>
                    {{-- Application Information --}}
                    @if (Auth::user()->applicant)
                        <li>@yield('step-1-dot-done')</li>
                        {{-- Document Requirements --}}
                        @if (Auth::user()->documents)
                            @if ($_document_status)
                                <li>@yield('step-2-dot-done')</li>
                                {{-- BMA ALUMNIA PRIVILEGE --}}
                                @if (Auth::user()->is_alumnia)
                                    <li>@yield('step-3-dot-alumnia')</li>
                                    <li>@yield('step-4-dot-alumnia')</li>
                                    @if (Auth::user()->virtual_briefing)
                                        <li>@yield('step-5-dot-done')</li>
                                        <li>
                                            @if (Auth::user()->medical_appointment)

                                                @if (Auth::user()->medical_result)
                                                    @yield('step-6-dot-done')
                                                    @if (Auth::user()->medical_result->is_fit === 1)
                                                        <h5 class="fw-bolder text-primary">MEDICAL EXAMINATION PASSED</h5>
                                                        <p>Congratulation, Your Medical Examination was Passed, you can now
                                                            proceed to Enrollment </p>
                                                        <a href="{{ route('applicant.enrollment') }}"
                                                            class="btn btn-outline-primary rounded-pill">Enroll Now</a>
                                                    @else
                                                        @if (Auth::user()->medical_result->is_fit === 2)
                                                            <h5 class="fw-bolder text-danger">MEDICAL EXAMINATION FAILED
                                                            </h5>
                                                        @endif
                                                        @if (Auth::user()->medical_result->is_pending === 0)
                                                            <h5 class="fw-bolder text-info">MEDICAL EXAMINATION PEDING</h5>
                                                            <p>{{ Auth::user()->medical_result->remarks }}</p>
                                                        @endif
                                                    @endif
                                                @else
                                                    @yield('step-6-dot-active')
                                                    @yield('step-6-active-content')
                                                @endif
                                            @else
                                                @yield('step-6-dot-active')
                                                @yield('step-6-active-content')
                                            @endif
                                        </li>
                                    @else
                                        <li>@yield('step-5-dot-active')</li>
                                        <li>@yield('step-6-dot')</li>
                                    @endif
                                @else
                                    {{-- Entrance Examination Payment --}}
                                    @if (Auth::user()->payment)
                                        @if (Auth::user()->payment->is_approved == 1)
                                            <li>@yield('step-3-dot-done')</li>
                                            {{-- Entrance Examination --}}
                                            @if (Auth::user()->examination)
                                                @if (Auth::user()->examination->is_finish === 1)
                                                    <li> @yield('step-4-dot-done')</li>
                                                    @if (Auth::user()->examination->result())
                                                        @if (Auth::user()->virtual_briefing)
                                                            <li>@yield('step-5-dot-done')</li>
                                                            <li>
                                                                @if (Auth::user()->medical_appointment)

                                                                    @if (Auth::user()->medical_result)
                                                                        @yield('step-6-dot-done')
                                                                        @if (Auth::user()->medical_result->is_fit === 1)
                                                                            <h5 class="fw-bolder text-primary">MEDICAL
                                                                                EXAMINATION PASSED</h5>
                                                                            <p>Congratulation, Your Medical Examination was
                                                                                Passed, you can now
                                                                                proceed to Enrollment </p>
                                                                            <a href="{{ route('applicant.enrollment') }}"
                                                                                class="btn btn-outline-primary rounded-pill">Enroll
                                                                                Now</a>
                                                                        @else
                                                                            @if (Auth::user()->medical_result->is_fit === 2)
                                                                                <h5 class="fw-bolder text-danger">MEDICAL
                                                                                    EXAMINATION FAILED
                                                                                </h5>
                                                                            @endif
                                                                            @if (Auth::user()->medical_result->is_pending === 0)
                                                                                <h5 class="fw-bolder text-info">MEDICAL
                                                                                    EXAMINATION PEDING</h5>
                                                                                <p>{{ Auth::user()->medical_result->remarks }}
                                                                                </p>
                                                                            @endif
                                                                        @endif
                                                                    @else
                                                                        @yield('step-6-dot-active')
                                                                        @yield('step-6-active-content')
                                                                    @endif
                                                                @else
                                                                    @yield('step-6-dot-active')
                                                                    @yield('step-6-active-content')
                                                                @endif
                                                            </li>
                                                        @else
                                                            <li>@yield('step-5-dot-active')</li>
                                                            <li>@yield('step-6-dot')</li>
                                                        @endif
                                                    @else
                                                        <li>@yield('step-5-dot')</li>
                                                        <li>@yield('step-6-dot')</li>
                                                    @endif
                                                @else
                                                    <li>@yield('step-4-dot-active')</li>
                                                    <li>@yield('step-5-dot')</li>
                                                    <li>@yield('step-6-dot')</li>
                                                @endif
                                            @else
                                                <li>@yield('step-4-dot-active')</li>
                                                <li>@yield('step-5-dot')</li>
                                                <li>@yield('step-6-dot')</li>
                                            @endif
                                        @else
                                            <li>
                                                @yield('step-3-dot-active')
                                                @yield('payment-transaction-view')</li>
                                            </li>
                                            <li>@yield('step-4-dot')</li>
                                            <li>@yield('step-5-dot')</li>
                                            <li>@yield('step-6-dot')</li>
                                        @endif
                                    @else
                                        <li>
                                            @yield('step-3-dot-active')
                                            @yield('payment-view')</li>
                                        </li>
                                        <li>@yield('step-4-dot')</li>
                                        <li>@yield('step-5-dot')</li>
                                        <li>@yield('step-6-dot')</li>
                                    @endif
                                @endif
                            @else
                                <li>@yield('step-2-dot-active-content')</li>
                                <li>@yield('step-3-dot')</li>
                                <li>@yield('step-4-dot')</li>
                                <li>@yield('step-5-dot')</li>
                                <li>@yield('step-6-dot')</li>
                            @endif
                        @else
                            <li>@yield('step-2-dot-active')</li>
                            <li>@yield('step-3-dot')</li>
                            <li>@yield('step-4-dot')</li>
                            <li>@yield('step-5-dot')</li>
                            <li>@yield('step-6-dot')</li>
                        @endif
                    @else
                        <li> @yield('step-1-dot-active')</li>
                        <li> @yield('step-2-dot')</li>
                        <li> @yield('step-3-dot')</li>
                        <li> @yield('step-4-dot')</li>
                        <li>@yield('step-5-dot')</li>
                        <li>@yield('step-6-dot')</li>
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
