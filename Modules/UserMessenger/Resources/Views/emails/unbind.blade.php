@extends('usermessenger::emails.layout')

@section('content')
    <h4>Change email address</h4>
    <b>
        <a href="{{ url('confirm/confirmChange') }}/{{ $user->id }}:{{ $user->confirmation_code }}:{{ $change }}">
            Click here to remove email address from GuardMe account
        </a>
    </b>
@endsection
