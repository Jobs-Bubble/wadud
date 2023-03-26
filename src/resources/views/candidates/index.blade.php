@extends('layouts.app')

@section('title', trans('default.candidates', [], app_get_locale()))

@section('contents')
    <candidates></candidates>
@endsection

