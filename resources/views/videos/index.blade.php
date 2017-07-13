@extends('layouts.app')

@section('content-title')
Video List
@endsection

@section('content-btns')
 <a href="{{ route('video.create') }}" class="btn btn-success">Create</a>
@endsection

@section('content-body')
<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th colspan="2">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($videos as $video)
        <tr>
          <td class="col-sm-2">{{ $video->id }}</td>
            <td class="col-sm-8">{{ $video->title }}</td>
            <td class="col-sm-1"><a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning">Edit</a></td>
            <td class="col-sm-1"><a href="{{ route('video.confirm', $video->id) }}" class="btn btn-danger">Delete</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection