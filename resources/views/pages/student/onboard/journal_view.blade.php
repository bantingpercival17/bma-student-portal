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
    @php
    $_narative_details = ['Training Record Book', 'Daily Journal', 'Crew List', "Master's Declaration of Safe Departure", 'Picture while at work'];
    @endphp
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <p class="card-title text-primary h4">
                            <b>{{ date('F - Y', strtotime(base64_decode(request()->input('_j')))) }}</b>
                        </p>
                        <small class="text-muted"><b>MONTH JOURNAL</b></small>
                    </div>
                    <div class="card-tool">
                        <a href="/student/on-board/journal/view?edit={{ request()->input('_j') }}"
                            class="btn btn-primary btn-sm mt-2">
                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.3764 20.0279L18.1628 8.66544C18.6403 8.0527 18.8101 7.3443 18.6509 6.62299C18.513 5.96726 18.1097 5.34377 17.5049 4.87078L16.0299 3.69906C14.7459 2.67784 13.1541 2.78534 12.2415 3.95706L11.2546 5.23735C11.1273 5.39752 11.1591 5.63401 11.3183 5.76301C11.3183 5.76301 13.812 7.76246 13.8651 7.80546C14.0349 7.96671 14.1622 8.1817 14.1941 8.43969C14.2471 8.94493 13.8969 9.41792 13.377 9.48242C13.1329 9.51467 12.8994 9.43942 12.7297 9.29967L10.1086 7.21422C9.98126 7.11855 9.79025 7.13898 9.68413 7.26797L3.45514 15.3303C3.0519 15.8355 2.91395 16.4912 3.0519 17.1255L3.84777 20.5761C3.89021 20.7589 4.04939 20.8879 4.24039 20.8879L7.74222 20.8449C8.37891 20.8341 8.97316 20.5439 9.3764 20.0279ZM14.2797 18.9533H19.9898C20.5469 18.9533 21 19.4123 21 19.9766C21 20.5421 20.5469 21 19.9898 21H14.2797C13.7226 21 13.2695 20.5421 13.2695 19.9766C13.2695 19.4123 13.7226 18.9533 14.2797 18.9533Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a>

                        <a href="{{ route('onboard.journal-remove') }}?_journal={{ request()->input('_j') }}"
                            class="btn btn-danger btn-sm mt-2"><svg xmlns="http://www.w3.org/2000/svg"
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
                        </a>
                    </div>
                </div>

            </div>
            @foreach ($_journal as $item)
                @if (in_array($item->journal_type, $_narative_details))
                    <div class="card">
                        <div class="card-body">
                            @php
                                $index = array_search($item->journal_type, $_narative_details);
                                unset($_narative_details[$index]);
                            @endphp
                            <div class="">
                                <h5 class="card-title">{{ strtoupper($item->journal_type) }}</h5>
                                {{-- <small class="text-muted">Last updated 3 mins ago</small> --}}
                                <p class="card-text">
                                    {{ $item->remark }}
                                </p>
                                <small class="fw-bolder"> Number of Item/s :
                                    {{ count(json_decode($item->file_links)) }}
                                </small>
                                <div class="table-responsive mt-4">
                                    @include('layouts.icon-main')
                                    <table id="basic-table" class="table table-striped mb-0" role="grid">
                                        <tbody>
                                            <tr>
                                                @foreach (json_decode($item->file_links) as $links)
                                                    <td>
                                                        <a class="btn-form-document col" data-bs-toggle="modal"
                                                            data-bs-target=".document-view-modal"
                                                            data-document-url="{{ $links }}">

                                                            @php
                                                                $myFile = pathinfo($links);
                                                                $_ext = $myFile['extension'];
                                                                $_file = $myFile['basename'];
                                                            @endphp
                                                            <div class="">
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
                                                                <br>
                                                                <small>
                                                                    {{ mb_strimwidth(str_replace('[' . str_replace('@bma.edu.ph', '', Auth::user()->campus_email) . ']', '', $_file),0,10,'...') }}</small>

                                                            </div>
                                                        </a>
                                                    </td>
                                                @endforeach
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-2">
                                    @if ($item->is_approved == 1)
                                        <label for="" class="fw-bolder text-primary">APPROVED DOCUMENTS</label>
                                        <div class="row">
                                            <div class="col-md">
                                                <label class="form-label text-muted">APPROVED BY: </label>
                                                <b>{{ $item->staff->first_name . ' ' . $item->staff->last_name }}</b>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label text-muted">DATE APPROVED: </label>
                                                <b>{{ $item->updated_at->format('F d, Y') }}</b>
                                            </div>
                                        </div>
                                    @elseif($item->is_approved == 2)
                                        <label for="" class="fw-bolder text-danger">DISAPPROVED DOCUMENTS</label>
                                        <div class="form-group">
                                            <label for="" class="form-label fw-bolder">COMMENT</label>
                                            <input type="text" class="form-control" value="{{ $item->feedback }}"
                                                readonly>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <small class="text-muted">APPROVED BY: </small>
                                                <b>{{ $item->staff->first_name . ' ' . $item->staff->last_name }}</b>
                                            </div>
                                            <div class="">
                                                <small class="text-muted">DATE APPROVED: </small>
                                                <b>{{ $item->updated_at->format('F d, Y') }}</b>
                                            </div>
                                        </div>
                                        <form action="{{ route('onboard.reupload-file') }}" method="post"
                                            class="mt-2">
                                            <span class="fw-bolder text-info">RE-UPLOAD DOCUMENTS</span>
                                            @csrf
                                            <input type="hidden" class="token" name="_token"
                                                value="{{ csrf_token() }}" />
                                            <input type="hidden" name="_month" value="{{ $item->month }}">
                                            <input type="hidden" name="_name" value="{{ $item->journal_type }}">
                                            <div class="form-group">
                                                <small class="form-label"><b>ATTACH FILES<sup
                                                            class="text-danger">*</sup></b></small>
                                                <input class="form-control file-input" id="{{ $item->id }}"
                                                    data-name={{ $item->id }} type="file" multiple required
                                                    accept="img">
                                                <input type="hidden" class="{{ $item->id }}-file" name="_file_url"
                                                    value="{{ old($item->id) }}">
                                                <input type="hidden" name="_remarks" value="{{ $item->remark }}">
                                                <div class="image_frame{{ $item->id }} row mt-2">
                                                </div>
                                                @error($item->id)
                                                    <small class="text-danger"><b>{{ $message }}</b></small>
                                                @enderror
                                                <div class="invalid-feedback">
                                                    Please attach a files for {{ ucwords($item->journal_type) }} .
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
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
                                                    <small class="form-label"><b>ATTACH FILES<sup
                                                                class="text-danger">*</sup></b></small>
                                                    <input class="form-control file-input" id="{{ $_name[1] }}"
                                                        data-name={{ $_name[1] }} type="file" multiple required
                                                        accept="img">
                                                    <input type="hidden" class="{{ $_name[1] }}-file"
                                                        name="{{ $_name[1] }}" value="{{ old($_name[1]) }}">

                                                    <div class="image_frame{{ $_name[1] }} row mt-2">
                                                    </div>
                                                    @error($_name[1])
                                                        <small class="text-danger"><b>{{ $message }}</b></small>
                                                    @enderror
                                                    <div class="invalid-feedback">
                                                        Please attach a files for {{ ucwords($_name[0]) }} .
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <button class="btn btn-primary btn-sm w-100" type="submit">SUBMIT</button>
                                        </form>
                                    @else
                                        <p class="text-muted">This document is under checking for Onboard Training
                                            Office</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            @foreach ($_narative_details as $_name)
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('onboard.recent-file-upload') }}" method="post">
                            <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="_name" value="{{ $_name }}">
                            <input type="hidden" name="_month" value="{{ request()->input('_j') }}">
                            <div class="form-group">
                                <p class="h6">
                                    <b>{{ strtoupper($_name) }}</b>
                                </p>
                                @if (in_array($_name, ['Training Record Book', 'Daily Journal']))
                                    <div class="form-group">
                                        <small class="form-label"><b>REMARKS<sup
                                                    class="text-danger">*</sup></b></small>
                                        <textarea name="_remarks" class="form-control" cols="30" rows="3" required>{{ old($_name) }}</textarea>
                                        @error($_name)
                                            <small class="text-danger"><b>{{ $message }}</b></small>
                                        @enderror
                                    </div>
                                @endif


                                <div class="form-group">
                                    <small class="form-label"><b>ATTACH TRB FILES<sup
                                                class="text-danger">*</sup></b></small>
                                    <input class="form-control file-input"
                                        id="{{ str_replace(' ', '_', strtolower($_name)) }}"
                                        data-name={{ str_replace(' ', '_', strtolower($_name)) }} type="file" multiple
                                        required accept="img">
                                    <input type="hidden" class="{{ str_replace(' ', '_', strtolower($_name)) }}-file"
                                        name="_file_url" value="{{ old(str_replace(' ', '_', strtolower($_name))) }}">

                                    <div class="image_frame{{ str_replace(' ', '_', strtolower($_name)) }} row mt-2">
                                    </div>
                                    @error(str_replace(' ', '_', strtolower($_name)))
                                        <small class="text-danger"><b>{{ $message }}</b></small>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Please attach a files for {{ ucwords($_name[0]) }} .
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-sm" type="submit">SUBMIT</button>
                            </div>
                        </form>

                    </div>
                </div>

                <hr>
            @endforeach
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
    <div class="modal fade document-view-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Document Review</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="btn-group " role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary btn-sm" onclick="rotateImg(Math.PI/2)">Rotate
                            Left</button>
                        {{-- <button type="button" class="btn btn-primary btn-sm" onclick="initDraw()">Reset</button> --}}
                        <button type="button" class="btn btn-primary btn-sm" onclick="view.rotate(Math.PI/2)">Rotate
                            Right</button>
                    </div>
                </div>
                <iframe class="iframe-container form-view iframe-placeholder" width="100%" height="600px">
                </iframe>
            </div>
        </div>
    </div>
@section('js')
    <script src="{{ asset('resources/js/plugins/file-uploads.js') }}"></script>
    <script src="{{ asset('resources/js/plugins/custom-document-viewer.js') }}"></script>
@endsection
@endsection
