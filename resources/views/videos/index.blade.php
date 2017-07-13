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
        <th>Duration</th>
        <th>Bit Rate</th>
        <th>Size</th>
        <th>Format</th>
        <th colspan="2">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($videos as $video)
        <tr>
          <td>{{ $video->id }}</td>
          <td>{{ $video->title }}</td>
          <td>{{ $video->duration }}</td>
          <td>{{ $video->bit_rate }}</td>
          <td>{{ FormatHelper::getSize($video->size, 2) }}</td>
          <td>{{ $video->format }}</td>
          <td class="col-sm-1"><a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning">Edit</a></td>
          <td class="col-sm-1"><a href="{{ route('video.confirm', $video->id) }}" class="btn btn-danger">Delete</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection