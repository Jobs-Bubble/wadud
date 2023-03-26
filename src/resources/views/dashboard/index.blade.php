@extends('layouts.app')

@section('title', trans('default.dashboard_title', [], app_get_locale()))

@section('contents')
    <dashboard></dashboard>
@endsection
