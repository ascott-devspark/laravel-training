@extends('layouts.app')

@section('content-title')
Delete User
@endsection

@section('content-body')
{{ Form::open(['route' => ['user.destroy', $user->id], 'class' => 'form']) }}
    {{ Form::hidden('_method', 'DELETE') }}
    <p>Are you sure you want to delete the <strong>{{ $user->name }}</strong> user?</p>
    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
    <a href="{{ route('user.index') }}" class="btn btn-default">Cancel</a>
{{ Form::close() }}
@endsection