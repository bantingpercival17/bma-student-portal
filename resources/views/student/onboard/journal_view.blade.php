@extends('app-main')
@php
$_title = 'Narative Report';
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
                        <p class="card-title text-primary h4">
                            <b>{{ date('F - Y', strtotime(base64_decode(request()->input('_j')))) }}</b>
                        </p>
                        <small class="text-muted"><b>MONTH JOURNAL</b></small>
                    </div>
                    {{-- <div class="card-tool">
                        <a href="/student/on-board/journal?edit={{ request()->input('_j') }}"
                            class="btn btn-primary btn-sm mt-2">
                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.3764 20.0279L18.1628 8.66544C18.6403 8.0527 18.8101 7.3443 18.6509 6.62299C18.513 5.96726 18.1097 5.34377 17.5049 4.87078L16.0299 3.69906C14.7459 2.67784 13.1541 2.78534 12.2415 3.95706L11.2546 5.23735C11.1273 5.39752 11.1591 5.63401 11.3183 5.76301C11.3183 5.76301 13.812 7.76246 13.8651 7.80546C14.0349 7.96671 14.1622 8.1817 14.1941 8.43969C14.2471 8.94493 13.8969 9.41792 13.377 9.48242C13.1329 9.51467 12.8994 9.43942 12.7297 9.29967L10.1086 7.21422C9.98126 7.11855 9.79025 7.13898 9.68413 7.26797L3.45514 15.3303C3.0519 15.8355 2.91395 16.4912 3.0519 17.1255L3.84777 20.5761C3.89021 20.7589 4.04939 20.8879 4.24039 20.8879L7.74222 20.8449C8.37891 20.8341 8.97316 20.5439 9.3764 20.0279ZM14.2797 18.9533H19.9898C20.5469 18.9533 21 19.4123 21 19.9766C21 20.5421 20.5469 21 19.9898 21H14.2797C13.7226 21 13.2695 20.5421 13.2695 19.9766C13.2695 19.4123 13.7226 18.9533 14.2797 18.9533Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm mt-2"><svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-trash" width="20" height="20" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="4" y1="7" x2="20" y2="7"></line>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                        </button>
                    </div> --}}
                </div>
                <div class="card-body">
                    @foreach ($_journal as $item)
                        <div class="">
                            <h5 class="card-title">{{ strtoupper($item->journal_type) }}</h5>
                            {{-- <small class="text-muted">Last updated 3 mins ago</small> --}}
                            <p class="card-text">
                                {{ $item->remark }}
                            </p>
                            <div class="d-grid gap-card grid-cols-4">
                                @include('layouts.icon-main')
                                @foreach (json_decode($item->file_links) as $links)
                                    <a data-fslightbox="gallery" href="{{ $links }}" target="_blank">

                                        @php
                                            $myFile = pathinfo($links);
                                            $_ext = $myFile['extension'];
                                            $_file = $myFile['basename'];
                                        @endphp
                                        <div class="row">
                                            <div class="col-md">
                                                @if ($_ext == 'docx' || $_ext == 'doc')
                                                    @yield('icon-doc')
                                                @elseif ($_ext == 'pdf')
                                                    @yield('icon-pdf')
                                                @elseif ($_ext == 'png')
                                                    @yield('icon-png')
                                                @elseif ($_ext == 'jpg' || $_ext == 'jpeg')
                                                    @yield('icon-jpg')
                                                @else
                                                @endif

                                            </div>
                                            <div class="col-md">
                                                <small>
                                                    {{ mb_strimwidth(str_replace('[' . str_replace('@bma.edu.ph', '', Auth::user()->campus_email) . ']', '', $_file),0,10,'...') }}</small>

                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                            <br>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <label for="" class="card-title h5"><b>RECENT JOURNAL</b></label>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($_journals) > 0)
                        @foreach ($_journals as $_journal)
                            <a href="{{ route('onboard.view-journal') }}?_j={{ base64_encode($_journal->month) }}">
                                <div class="d-flex justify-content-start align-items-center">

                                    <div class="pe-3">
                                        <i class="icon text-muted">
                                            @yield('icon-document')
                                        </i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ date('F - Y', strtotime($_journal->month)) }}</h6>
                                        {{-- <p class="mb-0">Today</p> --}}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
