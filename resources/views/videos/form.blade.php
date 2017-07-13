<div class="form-group">
    {{ Form::label('Title') }}
    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Video Title']) }}
</div>
<div class="form-group">
    {{ Form::label('Video') }}
    {{ Form::file('file', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('Duration') }}
    {{ Form::text('duration', null, ['class' => 'form-control', 'placeholder' => 'Video Duration']) }}
</div>
<div class="form-group">
    {{ Form::label('Bit Rate') }}
    {{ Form::text('bit_rate', null, ['class' => 'form-control', 'placeholder' => 'Video Bit Rate']) }}
</div>
<div class="form-group">
  {{ Form::label('Location') }}
  {{ Form::select('location_id', $locations, null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
  {{ Form::label('Tags') }}
  <div class="clearfix">
    @foreach($tags as $tag)
    <label class="checkbox-inline">
      <input 
        type="checkbox" 
        name="tag[]" 
        id="tag-{{ $tag['id'] }}" 
        value="{{ $tag['id'] }}" 
        @if ($tag['checked'] == 1)
        checked=true
        @endif
      /> {{ $tag['name'] }}
    </label>
    @endforeach
  </div>
</div>