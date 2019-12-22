<div class="row">

  <div class="col-md-8">
    @php
    $input="name";
    @endphp
    <div class="form-group">
      <label class="bmd-label-floating">Tag Name</label>
      <input type="text" name="{{$input}}" value="{{ isset($row) ? $row->{$input}: '' }}" class="form-control  @error($input) is-invalid @enderror">
      @error($input)
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  </div>
