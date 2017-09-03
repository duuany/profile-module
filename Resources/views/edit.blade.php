@extends('profile::layouts.master')

@section('content')
    <div class="container">

        @include('flash::message')

        <h1>Profile: {{ $user->name }}</h1>

        <p>This page its loaded by Profile Module.</p>
        <p>Fill your profile update FORM here.</p>

    </div>
@endsection