@extends('mailmessenger::emails.canvas-theme-layout')

@section('content')
    <h2 class="flow-text uk-text-center">
        Welcome to <span class="fg-site-blue">Guard</span><span class="fg-site-green">Me</span>
    </h2>

    <p>
        Hello, {{$user->email}}
    </p>
@endsection