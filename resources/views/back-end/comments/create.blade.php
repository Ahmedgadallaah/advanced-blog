<form action="{{ route('comment.store')}}" method="post" >
    {{ csrf_field() }}
    @include('back-end.comments.form')
    <input type="hidden" value="{{$row->id}}" name="video_id" >
    <button type="submit" class="btn btn-primary pull-right">ADD {{$moduleName}}</button>
    <div class="clearfix"></div>
</form>