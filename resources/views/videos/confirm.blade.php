@extends('layouts.app')

@section('content-title')
Delete Video
@endsection

@section('content-body')
{{ Form::open(['route' => ['video.destroy', $video->id], 'class' => 'form']) }}
    {{ Form::hidden('_method', 'DELETE') }}
    <p>Are you sure you want to delete the <strong>{{ $video->title }}</strong> video?</p>
    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
    <a href="{{ route('video.index') }}" class="btn btn-default">Cancel</a>
{{ Form::close() }}
@endsection