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
                                                            {{ $item->message }}
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
                                                    <div class="toast fade show bg-secondary text-white border-0 mb-1">
                                                        <div class="toast-body">
                                                            {{ $item->message }}
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
                                <p class="badge bg-warning">Please the Respond of the dedicated department for your
                                    issue</p>
                            @endif

                            <form action="" class="comment-text d-flex align-items-center mt-3" id="chat-inputs">


                                <input type="text" id="message-input" class="form-control rounded-pill"
                                    placeholder="Compose message!" {{ count($messages) > 0 ? '' : 'disabled' }}>
                                {!! csrf_field() !!}
                                <input type="hidden" class="ticket" value="{{ $ticket->concern->id }}">
                                <input type="hidden" class="staff"
                                    value="{{ $ticket->concern->chat->staff_id }}">
                                <div class="comment-attagement d-flex">

                                    <a href="#" class="me-2" data-bs-toggle="tooltip" title=""
                                        data-bs-original-title="Resolved Concern!">
                                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path d="M8.43994 12.0002L10.8139 14.3732L15.5599 9.6272" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(".chat-messages").animate({
            scrollTop: 20000000
        }, "slow");

        $('#chat-inputs').on('submit', function(evt) {
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
