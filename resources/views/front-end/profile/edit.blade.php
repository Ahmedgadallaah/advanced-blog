<div class="card left">
  <div class="card-header">
      <h4 style="margin-top:-5px;">Update Profile</h4>
  </div>
  <div class="card-body">
  <form action="{{ route('profile.update')}}" method="post">
   {{csrf_field() }}
   <div class="row">
    <div class="col-md-5">
         @php
         $input="name";
         @endphp
         <div class="form-group">
             <label class="bmd-label-floating">User Name</label>
             <input type="text" name="{{$input}}" value="{{ isset($user) ? $user->{$input}: '' }}" class="form-control  @error($input) is-invalid @enderror">
             @error($input)
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
             @enderror
         </div>
     </div>

     <div class="col-md-5">
         @php
         $input="email";
         @endphp
         <div class="form-group">
             <label class="bmd-label-floating">Email address</label>
             <input type="email" name="{{$input}}" value="{{ isset($user) ? $user->{$input}: '' }}" class="form-control  @error($input) is-invalid @enderror">
             @error($input)
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
             @enderror
         </div>
     </div>
     <div class="col-md-5">
         @php
         $input="password";
         @endphp

         <div class="form-group">
             <label class="bmd-label-floating">Passowrd</label>
             <input type="password" name="{{$input}}" class="form-control  @error($input) is-invalid @enderror">
             @error($input)
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
             @enderror
         </div>
     </div>
   </div>
   <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
    <div class="clearfix"></div>
 </form>   
  
  </div>
</div>

