@extends('layouts.app')

@section('content-title')
New Video
@endsection

@section('content-body')
{{ Form::open(['route' => 'video.store', 'class' => 'form', 'method' => 'POST', 'files' => true]) }}

    @include('videos.form')

    {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}    
    <a href="{{ route('video.index') }}" class="btn btn-default">Cancel</a>

{{ Form::close() }}
@endsection
