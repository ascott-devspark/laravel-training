@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="left">Dashboard</div>
                    <div class="right"><a href="{{ route('video.create') }}" class="btn btn-success">Create</a></div>
                </div>
                <div class="panel-body">
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
                                <td>{{ $video->id }}</td>
                                <td>{{ $video->title }}</td>
                                <td><a href="{{ action('video.edit', $video->id) }}" class="btn btn-warning">Edit</a></td>
                                <td><a href="{{ action('video.destroy', $video->id) }}" class="btn btn-danger">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection