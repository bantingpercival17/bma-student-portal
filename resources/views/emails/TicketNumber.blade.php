@component('mail::message')
# TICKET SUBMITTED

Good day {{ $data->name }},
<p>
This email is to confirm that we have received your concern about
<b><i>{{ $data->concern_issue->issue->issue_name }}</i></b>.
</p>
<p>
We're sorry about the inconvenience you experienced with this issue. The Concern Department will respond to you on
this matter. We will keep you updated via email.
</p>
<p>
If your concern have been solved, kindly confirm by marking as solved in our <a
    href="{{ route('ticket-view') . '?_t=' . base64_encode($data->ticket_number) }}">site</a>, so we can close your
ticket.
</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
