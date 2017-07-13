@extends('layouts.app')

@section('content-title')
Edit Video
@endsection

@section('content-body')
{{ Form::model($video, ['route' => ['video.update', $video->id], 'class' => 'form', 'method' => 'PUT', 'files' => true]) }}

    @include('videos.form')

    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
    <a href="{{ route('video.index') }}" class="btn btn-default">Cancel</a>

{{ Form::close() }}
@endsection