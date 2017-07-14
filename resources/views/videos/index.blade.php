@extends('layouts.app')

@section('content-title')
Video List
@endsection

@section('content-btns')
  @permission('add-edit-video')
 <a href="{{ route('video.create') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
  @endpermission
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
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($videos as $video)
        <tr>
          <td>{{ $video->id }}</td>
          <td>{{ $video->title }} <small>({{ $video->likesCount }} Likes)</small></td>
          <td>{{ $video->duration }}</td>
          <td>{{ $video->bit_rate }}</td>
          <td>{{ FormatHelper::getSize($video->size, 2) }}</td>
          <td>{{ $video->format }}</td>
          <td>
            @permission('play-video')
              <a href="{{ route('video.show', $video->id) }}" class="btn btn-success"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
            @endpermission
            @permission('add-edit-video')
              <a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
            @endpermission
            @permission('delete-video')
              <a href="{{ route('video.confirm', $video->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
            @endpermission
        </tr>
    @endforeach
    </tbody>
</table>
@endsection