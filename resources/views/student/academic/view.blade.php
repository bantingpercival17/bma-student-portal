@extends('app-main')
@php
$_title = 'Academic';
@endphp
@section('page-title', $_title)
@section('content-title', $_title)
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
    <div class="row">
        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Academic</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="twit-feed">
                        <div class="d-flex align-items-center mb-4">
                            <img class="rounded-pill img-fluid avatar-60 me-3" src="../../assets/images/avatars/01.png"
                                alt="">
                            <div class="media-support-info">
                                <h6 class="mb-0">Anna Sthesia</h6>
                                <p class="mb-0">@anna59
                                    <span class="text-primary">
                                        <svg width="15" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M10,17L5,12L6.41,10.58L10,14.17L17.59,6.58L19,8M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z">
                                            </path>
                                        </svg>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="media-support-body">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                            <div class="d-flex flex-wrap mb-1">
                                <a href="#" class="twit-meta-tag pe-2">#Html</a>
                                <a href="#" class="twit-meta-tag pe-2">#Bootstrap</a>
                            </div>
                            <div class="twit-date">07 Jan 2021</div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="twit-feed">
                        <div class="d-flex align-items-center mb-4">
                            <img class="rounded-pill p-1 bg-soft-primary img-fluid avatar-60 me-3"
                                src="../../assets/images/avatars/03.png" alt="">
                            <div class="media-support-info">
                                <h6 class="mb-0">Paige Turner</h6>
                                <p class="mb-0">@paige30
                                    <span class="text-primary">
                                        <svg width="15" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M10,17L5,12L6.41,10.58L10,14.17L17.59,6.58L19,8M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z">
                                            </path>
                                        </svg>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="media-support-body">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                            <div class="d-flex flex-wrap mb-1">
                                <a href="#" class="twit-meta-tag pe-2">#Js</a>
                                <a href="#" class="twit-meta-tag pe-2">#Bootstrap</a>
                            </div>
                            <div class="twit-date">18 Feb 2021</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="header-title">
                        <h4 class="card-title">Academic List</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if ($_academics->count() > 0)
                        <ul class="list-inline m-0 p-0">

                            @foreach ($_academics as $_academic)
                                <li class="d-flex mb-4 align-items-center">
                                  
                                    <div class="ms-3 flex-grow-1">
                                        <h6>{{$_academic->semester}}</h6>
                                        <p class="mb-0">{{$_academic->school_year}}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
