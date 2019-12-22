<div class="col-md-8">
  @php
    $input="comment";
    @endphp
  
    <div class="form-group">
      <label class="bmd-label-floating">comment</label>
      <textarea name="{{$input}}" cols="30" rows="5" class="form-control  @error($input) is-invalid @enderror">{{ isset($row) ? $row->{$input}: '' }}</textarea>
      @error($input)
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>