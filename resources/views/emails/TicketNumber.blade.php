@component('mail::message')
# {{$data->concern_issue->issue->issue_name}}
<small>REPORTED ISSUE</small>

Good day {{$data->name}},

<p>Click this button to view your Concern</p>

@component('mail::button', ['url' =>route('ticket-view') . '?_t=' .base64_encode($data->ticket_number)])
Visit Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
