@extends('layouts.app')

@section('title', $user->name )

<div class="section profile-content" style="margin-top:110px">
  <div class="container">
    <div class="owner">

      <div class="name">
        <h4 class="title">{{ $user->name }}
          <br>
        </h4>
        <h6 class="description">{{ $user->email }}</h6>
      </div>
    </div>
    @if(auth()->user() && $user->id == auth()->user()->id)
    <br>
    <div class="row">
      <div class="col-md-6 ml-auto mr-auto text-center">

        <btn class="btn btn-outline-default btn-round"><i class="fa fa-cog"></i>Update Profile</btn>
      </div>
    </div>
    @endif
    <br>
    
    @include('front-end.profile.edit')

    
  </div>
</div>



