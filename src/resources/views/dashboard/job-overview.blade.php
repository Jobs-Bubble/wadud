@extends('layouts.app')

@section('title', trans('default.overview', [], app_get_locale()))

@section('contents')
    <job-overview :job-post-id="{{$job_post_id}}"></job-overview>
@endsection
