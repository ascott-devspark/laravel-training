@extends('layouts.app')

@section('content-title')
User List
@endsection

@section('content-btns')
 <a href="{{ route('user.create') }}" class="btn btn-success">Create</a>
@endsection

@section('content-body')
<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('user.confirm', $user->id) }}" class="btn btn-danger">Delete</a>
          </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection