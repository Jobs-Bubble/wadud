@extends('auth-layouts.auth')

@section('title', trans('default.login', [], app_get_locale()))
@section('contents')
    <div id="app">
        <login set-email="{{$email}}"
               set-pass="{{$password}}"
               :config-data="{{ json_encode(config('settings.application')) }}">
        </login>
    </div>
@endsection
