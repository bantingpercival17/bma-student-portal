@extends('layouts.website-template')
@php
$_title = 'Ticket View- Baliwag Maritime Academy';
@endphp
@section('css')
    <style>
        .chat-messages {
            display: flex;
            flex-direction: column;
            height: 300px;
            overflow-y: scroll;
        }

        .chat-message-left,
        .chat-message-right {
            display: flex;
            flex-shrink: 0;
        }

        .chat-message-left {
            margin-right: auto;
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto;

        }

        .py-3 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }

        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }

    </style>
@endsection
@section('page-title', $_title)
@section('page-content')
    <h2 class="text-primary text-center home-title">
        Ticket View
    </h2>
    <div class="card mt-3 rounded">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-3">Ticket Number:
                            <span class="text-primary"> {{ $ticket->ticket_number }} </span>
                        </h4>
                        <h6 class="mb-0">Issue Date: {{ $ticket->created_at->format('M d,Y') }}</h6>
                    </div>
                    <p class="h4">
                        <small class="text-muted">REPORT BY: </small>
                        <span class="text-info fw-bolder"> {{ $ticket->name }} </span>

                    </p>
                    <p class="h6">
                        <span class="text-muted">REPORT ISSUE: </span>
                        <span class="text-info fw-bolder"> {{ $ticket->concern->issue->issue_name }} </span>

                    </p>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-4">
                    <div class="card m-0">
                        <div class="card-header d-flex align-items-center justify-content-between p-3">
                            <div class="header-title">
                                <div class="d-flex flex-wrap">
                                    <div class="media-support-user-img me-3">
                                        <img src="https://ui-avatars.com/api/?name={{ $ticket->name }}" alt="header"
                                            class="img-fluid avatar avatar-40">
                                    </div>
                                    <div class="media-support-info">
                                        <h6 class="m-0 fw-bolder">MESSAGE CONTENT</h6>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="chat-messages p-4">
                            <div class="chat-message-right">
                                <div class="d-flex">
                                    <div class="ms-3">
                                        <div class="d-flex flex-wrap ">
                                            <small class="mb-1 fw-bolder text-primary">
                                                YOU
                                            </small>
                                        </div>
                                        <div class="toast fade show bg-secondary text-white border-0">
                                            <div class="toast-body">
                                                {{ $ticket->concern->ticket_message }}
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap float-end">

                                            <small class="mb-1 text-end">
                                                {{ $ticket->concern->created_at->diffForHumans() }}
                                            </small>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (count($messages) > 0)
                                @foreach ($messages as $item)
                                    @if ($item->sender_column == 'ticket_id')
                                        <div class="chat-message-right">
                                            <div class="d-flex">
                                                <div class="ms-3">
                                                    <div class="d-flex flex-wrap ">
                                                        <small class="mb-1 fw-bolder text-primary">
                                                            YOU
                                                        </small>
                                                    </div>
                                                    <div class="toast fade show bg-secondary text-white border-0">
                                                        <div class="toast-body">
                                                            @php
                                                                echo $item->message;
                                                            @endphp
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-wrap float-end">

                                                        <small class="mb-1 text-end">
                                                            {{ $item->created_at->diffForHumans() }}
                                                        </small>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($item->sender_column == 'staff_id')
                                        <div class="chat-message-left">
                                            <div class="d-flex">
                                                <img src="https://ui-avatars.com/api/?name={{ $item->staff->first_name }}"
                                                    alt="header" class="img-fluid avatar avatar-40 rounded">
                                                <div class="ms-3">
                                                    <small class="mb-1 fw-bolder text-primary">
                                                        {{ $item->staff->first_name . ' ' . $item->staff->last_name }}
                                                    </small>
                                                    <div class="toast fade show bg-primary text-white border-0 mb-1">
                                                        <div class="toast-body">
                                                            @php
                                                                echo $item->message;
                                                            @endphp
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-wrap align-items-center">
                                                        <small class="mb-1">
                                                            {{ $item->created_at->diffForHumans() }}
                                                        </small>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="card-footer text-center">
                            @if (!count($messages) > 0)
                                <p class="badge bg-info">Please wait for the Respond of the dedicated department for your
                                    issue.</p>
                            @endif

                            <form action="" class="comment-text d-flex align-items-center mt-3 chat-inputs">


                                <input type="text" id="message-input" class="form-control rounded-pill "
                                    placeholder="Compose message!" {{ count($messages) > 0 ? '' : 'disabled' }}>
                                {!! csrf_field() !!}
                                <input type="hidden" class="ticket" value="{{ $ticket->concern->id }}">
                                <input type="hidden" class="staff"
                                    value="{{ $ticket->concern->chat ? $ticket->concern->chat->staff_id : '' }}">

                                <div class="comment-attagement d-flex">
                                    <a class="btn btn-outline-secondary rounded-pill btn-sm me-2" data-bs-toggle="modal"
                                        data-bs-target=".view-modal" data-bs-toggle="tooltip" title=""
                                        data-bs-original-title="Attach Image">
                                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.38948 8.98403H6.45648C4.42148 8.98403 2.77148 10.634 2.77148 12.669V17.544C2.77148 19.578 4.42148 21.228 6.45648 21.228H17.5865C19.6215 21.228 21.2715 19.578 21.2715 17.544V12.659C21.2715 10.63 19.6265 8.98403 17.5975 8.98403L16.6545 8.98403"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path d="M12.0215 2.19044V14.2314" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.10645 5.1189L12.0214 2.1909L14.9374 5.1189" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <button type="submit" class="btn btn-outline-primary rounded-pill btn-sm"
                                        data-bs-toggle="tooltip" title="" data-bs-original-title="Resolved   Concern!">
                                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.8325 8.17463L10.109 13.9592L3.59944 9.88767C2.66675 9.30414 2.86077 7.88744 3.91572 7.57893L19.3712 3.05277C20.3373 2.76963 21.2326 3.67283 20.9456 4.642L16.3731 20.0868C16.0598 21.1432 14.6512 21.332 14.0732 20.3953L10.106 13.9602"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="form-modal-view" class="modal fade view-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Attach Image</h5>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </a>
                </div>
                <div class="modal-body">
                    <form role="form" id="form-modal">
                        <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" class="_ticket_number" value={{ request()->input('_t') }}>
                        <input type="hidden" class="modal-ticket" value="{{ $ticket->concern->id }}">
                        <input type="hidden" class="modal-staff"
                            value="{{ $ticket->concern->chat ? $ticket->concern->chat->staff_id : '' }}">
                        <div class="form-group">

                            <small class="form-label"><b>ATTACH FILES<sup class="text-danger">*</sup></b></small>
                            <input class="form-control file-input" id="ticket"
                                data-url="{{ route('ticket.file-upload') }}" data-name="ticket" type="file" multiple
                                accept="image/jpeg, image/png">
                            <input type="hidden" class="upload-file" name="file_url[]" value="">

                            <div class="image-frame-ticket row mt-2 mb-3">
                            </div>
                            <input type="text" class="form-control rounded-pill ticket-file message-input"
                                placeholder="Compose message!" {{ count($messages) > 0 ? '' : 'disabled' }} required>

                        </div>
                        <button type="submit" class="btn btn-sm btn-primary w-100" data-bs-dismiss="modal" aria-label="Close">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- <script src="{{ asset('resources/js/plugins/file-uploads.js') }}"></script> --}}
    <script>
        file_upload()
        let input_file

        function file_upload() {
            $('.file-input').change(function() {
                input_file = [];
                var document = $(this).data('name');
                var files = $('#' + document)[0].files
                var url = $(this).data('url');
                $('.image-frame' + document).empty()
                for (let index = 0; index < files.length; index++) {
                    $('.image-frame-' + document).append(fileDisplay(files[index], index, document))
                    fileUpload(files[index], document, index, input_file, url)
                }
                console.log('.' + document + '-file')

            })
        }

        function fileUpload(file, document, index, input_file, url) {
            let request = new XMLHttpRequest();
            let data = new FormData();
            data.append('file', file)
            data.append('_token', $('.token').val())
            data.append('_documents', document)
            data.append('_file_number', index)
            data.append('_ticket_number', $('._ticket_number').val())
            let uploadProgress = $('.progress-bar-' + document + '-' + index)
            request.upload.onloadstart = function(e) {
                //console.log('Start Upload')
                uploadProgress.css({
                    width: '0%'
                })
            }
            request.upload.onprogress = function(e) {
                percentage = (e.total / e.loaded) * 100
                uploadProgress.css({
                    width: percentage + '%'
                })
                //console.log('uploading')
            }
           
            request.open("POST", url, true);
            request.send(data)
            request.onload = function() {
                if (request.readyState === request.DONE) {
                    if (request.status === 200) {
                        input_file.push(
                            '<a target="_blank" class="btn btn-primary btn-sm col-md mt-1 mb-1 ms-1" href="' +
                            request.responseText +
                            '">View image</a>')
                        //file_name = JSON.stringify(input_file);
                        $('.' + document + '-file').val(input_file)
                    }
                }
            };
            request.upload.onloadend = function(e) {
                //console.log('End uploading')
                uploadProgress.max = e.total
            }
        }

        function fileDisplay(files, index, document) {
            var layout = "<div class='col-md'>" +
                files.name.substring(0, 10).concat('...') +
                '<div class="progress bg-soft-success shadow-none w-100" style="height: 6px">' +
                '<div class="progress-bar progress-bar-' + document + '-' + index +
                ' bg-success" data-toggle="progress-bar" ></div>' +
                '</div>' +
                "</div>";
            return layout;
        }
    </script>
    <script>
        $(".chat-messages").animate({
            scrollTop: 20000000
        }, "slow");

        $('.chat-inputs').on('submit', function(evt) {
            evt.preventDefault();
            var message = $('#message-input').val()
            if (message.trim().length == 0) {
                $('#message-input').focus()
            } else {
                var data = {
                    'ticket': $('.ticket').val(),
                    'staff': $('.staff').val(),
                    '_token': $('input[name="_token"]').val(),
                    'message': message
                };
                send_data(data)
                $('#message-input').val("")
            }
        })
        $('#form-modal').on('submit', function(evt) {
            evt.preventDefault();
             var message = $('.message-input').val()
             if (message.trim().length == 0) {
                 $('.message-input').focus()
             } else {
                 var data = {
                     'ticket': $('.modal-ticket').val(),
                     'staff': $('.modal-staff').val(),
                     '_token': $('input[name="_token"]').val(),
                     'message': message
                 };
                 send_data(data)
                 $('#ticket').val("")
                 $('.message-input').val("")
                 $('.image-frame' + $(this).data('name')).empty()
             }
        })

        function send_data(data) {
            var html = append_chat(data)
            $.post("{{ route('ticket.chat-store') }}", data, function(respond) {
                if (respond.data.respond == 200) {
                    $('.chat-messages').append(html)
                    $('.chat-messages').animate({
                        scrollTop: $('.chat-messages').prop("scrollHeight")
                    }, 1000)
                }
                if (respond.data.respond == 404) {
                    //$('.chat-messages').append(html)
                    console.log(respond.data.message)
                    Swal.fire({
                        title: 'Error',
                        text: respond.data.message,
                        icon: 'error',
                        confirmButtonText: 'Okay'
                    })
                }
            })
        }

        function append_chat(data) {
            return `<div class="chat-message-right">
                    <div class="d-flex">
                        <div class="ms-3">
                            <div class="d-flex flex-wrap ">
                                <small class="mb-1 fw-bolder text-primary">
                                    YOU
                                </small>
                            </div>
                            <div class="toast fade show bg-secondary text-white border-0">
                                <div class="toast-body">
                                   ${data.message}
                                </div>
                            </div>
                            <div class="d-flex flex-wrap float-end">

                                <small class="mb-1 text-end">
                                    now
                                </small>

                            </div>
                        </div>
                    </div>
                </div>`;
        }
    </script>
@endsection
