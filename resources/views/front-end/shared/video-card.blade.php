<div class="card" style="width: 20rem;">
          <a href="{{ route('frontend.video', ['id'=> $video->id]) }}"><img class="card-img-top" src="{{ url('uploads/'.$video->image) }}" alt="{{$video->name}}" style="max-height:150px;"></a>
          <div class="card-body">
            <a href="{{ route('frontend.video', ['id'=> $video->id]) }}" title="{{ $video->name }}"><p class="card-text">{{ $video->name }}</p></a>
            <small>{{ $video->created_at }}</small>
          </div>
        </div>