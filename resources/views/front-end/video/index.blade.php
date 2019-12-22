@extends('layouts.app')

@section('title', $video->name )


@section('content')
<div class="section section-buttons">
  <div class="container">
    <div class="title">
      <h1>{{ $video->name }}</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        @php $url = getYoutubeId($video->youtube) @endphp
        @if($url)
        <iframe width="100%" height="500" src="https://www.youtube.com/embed/{{$url}}" frameborder="0" allowfullscreen></iframe>
        @endif

      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
          <p><i class="nc-icon nc-user-run"></i>  By: {{ $video->user->name }}</p>
        </div>
        <div class="col-md-2">
          <p><i class="nc-icon nc-watch-time"></i>{{ $video->created_at }}</p>
        </div>
       
      
      <div class="col-md-2">
      <i class="nc-icon nc-single-copy-04"></i> Categories:
        <p><a href="{{ route('front.category', ['id'=>$video->cat->id]) }}">{{ $video->cat->name }}</a></p>
      </div>
      <div class="col-md-2">
        <P>
        <i class="nc-icon nc-single-copy-04"></i> Tags:
          @foreach($video->tags as $tag)
          <br>
          <a href="{{ route('front.tags', ['id'=>$tag->id]) }}">
            <span class="badge badge-primary">{{ $tag->name }}</span></a>
          
            @endforeach
        </P>
      </div>
      <div class="col-md-2">
        <P>
        <i class="nc-icon nc-single-copy-04"></i>  Skills:
          @foreach($video->skills as $skill)
          <br>
          <a href="{{ route('front.skill', ['id'=>$skill->id]) }}">
            <span class="badge badge-info">{{ $skill->name }}</span></a>
         
            @endforeach
        </P>
      </div>
      
       <div class="col-md-12">
          <p>VideoDetails:<br>{{ $video->des }}</p>
        </div>
        
  </div>
  <br><br> 
    @include('front-end.video.comments')
    @include('front-end.video.create-comment')
    
              </div>
</div>


@endsection