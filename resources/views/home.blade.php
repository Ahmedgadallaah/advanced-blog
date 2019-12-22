@extends('layouts.app')
@section('content')
<div class="section section-buttons">
  <div class="container">
    <div class="title">
      <h2>Latest Videos</h2>
      @if(request()->has('search') && request()->get('search') !='')
        <h4>you are search for: <strong> {{request()->get('search')}}</strong> | <a href="{{ route('home') }}">Reset</a></h4>
      @endif
    </div>
    <div class="row">
      @foreach($videos as $video)
      <div class="col-lg-4">
        @include('front-end.shared.video-card')
      </div>
      @endforeach
    </div>
    <div class="row">
      <div class="col-lg-12">
  {{ $videos->links() }}
    </div>
    </div>
  </div>
</div>
@endsection