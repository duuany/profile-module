@extends('profile::layouts.master')

@section('content')
    <div class="container">

        @include('flash::message')

        <h1>Profile: {{ $user->name }}</h1>

        <p>This page its loaded by Profile Module.</p>
        <p>Put user profile information here and add a update button.</p>

    </div>
@stop
