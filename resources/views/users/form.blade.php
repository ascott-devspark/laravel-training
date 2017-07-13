<div class="form-group">
    {{ Form::label('Name') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'User Name']) }}
</div>
<div class="form-group">
    {{ Form::label('Email') }}
    {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'User Email']) }}
</div>
<div class="form-group">
    {{ Form::label('Password') }}
    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'User Password']) }}
</div>
<div class="form-group">
  {{ Form::label('Confirm Password') }}
  {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password Confirmation']) }}
</div>
<div class="form-group">
  {{ Form::label('Roles') }}
  <div class="clearfix">
    @foreach($roles as $rol)
    <label class="checkbox-inline">
      <input
        type="checkbox"
        name="rol[]"
        id="rol-{{ $rol['id'] }}"
        value="{{ $rol['id'] }}"
        @if ($rol['checked'] == 1)
        checked=true
        @endif
      /> {{ $rol['display_name'] }}
    </label>
    @endforeach
  </div>
</div>