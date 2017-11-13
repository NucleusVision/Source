@extends('emails.email-template')
@section('content')

Hi {{ $user->first_name." ".$user->last_name }},<br/><br/>

We have received a request to reset your password. To reset your password, click on the link below. If you cannot click on the link, copy and paste it into your browser.<br/><br/>

<a target="_blank" href="{{ url('/') }}/password/reset/{{ $token }}">{{ url('/') }}/password/reset/{{ $token }}</a><br/><br/>

If you didn't request this or if you no longer want to reset your password, please ignore and delete this message.<br/><br/>

Thank you,<br/><br/>

The BANG PAPERS team

@endsection