@extends('layouts.app')

@section('content-title')
Metadata List
@endsection

@section('content-body')
<div class="col-md-6">
    <h4><strong>Locations</strong></h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach($locations as $location)
                <tr>
                  <td>{{ $location->id }}</td>
                  <td>{{ $location->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="col-md-6">
    <h4><strong>Tags</strong></h4>
    <div class="table-responsive">
        <table class="table table-striped col-md-6">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection