@extends('layouts.app')

@section('content-title')
User List
@endsection

@section('content-btns')
 <a href="{{ route('user.create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
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
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
            <a href="{{ route('user.confirm', $user->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
          </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection