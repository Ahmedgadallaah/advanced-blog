<div class="row">
  <div class="col-md-8">
    @php
    $input="name";
    @endphp
    <div class="form-group">
      <label class="bmd-label-floating">Page Name</label>
      <input type="text" name="{{$input}}" value="{{ isset($row) ? $row->{$input}: '' }}" class="form-control  @error($input) is-invalid @enderror">
      @error($input)
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  <div class="col-md-8">
  @php
    $input="email";
    @endphp
    <div class="form-group">
      <label class="bmd-label-floating">Meta keywords</label>
      <input type="email" name="{{$input}}" value="{{ isset($row) ? $row->{$input}: '' }}" class="form-control  @error($input) is-invalid @enderror">
      @error($input)
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  <div class="col-md-8">
  @php
    $input="message";
    @endphp
  <div class="form-group">
      <label class="bmd-label-floating">Description</label>
      <textarea name="{{$input}}" cols="30" rows="10" class="form-control  @error($input) is-invalid @enderror">{{ isset($row) ? $row->{$input}: '' }}</textarea>
      @error($input)
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>
</div>

<hr/>

<h4>Replay On Message</h4>
<br>
<form action="{{ route('message.replay' , ['id'=> $row->id]) }}" method="post">
{{ csrf_field() }}
<div class="col-md-8">
  @php
    $input="message";
    @endphp
  <div class="form-group">
      <label class="bmd-label-floating">Message</label>
      <textarea name="{{$input}}" cols="30" rows="10" class="form-control  @error($input) is-invalid @enderror"></textarea>
      @error($input)
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>
  <button type="submit" class="btn btn-primary pull-right">Replay Message</button>
    <div class="clearfix"></div>

</div>
</form>