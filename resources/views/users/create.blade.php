@extends('layouts.app')

@section('content-title')
New User
@endsection

@section('content-body')
{{ Form::open(['route' => 'user.store', 'class' => 'form', 'method' => 'POST']) }}

    @include('users.form')

    {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}    
    <a href="{{ route('user.index') }}" class="btn btn-default">Cancel</a>

{{ Form::close() }}
@endsection
