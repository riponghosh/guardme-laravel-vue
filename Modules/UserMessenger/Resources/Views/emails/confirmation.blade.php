@extends('usermessenger::emails.layout')

@section('content')
    <h4>Welcome to GuardMe!</h4>
    <b>
        <a href="{{ url('confirm/email') }}/{{ $user->id }}:{{ $user->confirmation_code }}">
            Click here to confirm E-Mail address
        </a>
    </b>
@endsection
