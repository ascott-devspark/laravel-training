@extends('layouts.app')

@section('content-title')
Edit User
@endsection

@section('content-body')
{{ Form::model($user, ['route' => ['user.update', $user->id], 'class' => 'form', 'method' => 'PUT']) }}

    @include('users.form')

    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
    <a href="{{ route('user.index') }}" class="btn btn-default">Cancel</a>

{{ Form::close() }}
@endsection