@extends('layouts.app')

@section('content-title')
Preview Video User
@endsection

@section('content-body')
<h4>{{ $video->title }}  <like :video="{{ $video }}" :count="{{ $video->likesCount }}" :active="{{ $video->isLiked }}"></like></h4>
<p>Info: 
<ul>
  <li><strong>Duration:</strong> {{ $video->duration }}</li>
  <li><strong>Bit Rate:</strong> {{ $video->bit_rate }}</li>
  <li><strong>Size:</strong> {{ FormatHelper::getSize($video->size, 2) }}</li>
  <li><strong>Format:</strong> {{ $video->format }}</li>
</ul>
<video width="600px" controls>
    <source src="{{ $videofile }}" type="video/mp4">
    Your browser does not support HTML5 video.
</video>

<div class="clearfix">
  <a href="{{ route('video.index') }}" class="btn btn-default">Back</a>
</div>
@endsection
