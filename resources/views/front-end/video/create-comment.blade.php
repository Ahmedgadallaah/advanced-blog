@if(auth()->user())
    <form action="{{ route('front.commentStore' , ['id' => $video->id]) }}" method="post">
                {{ csrf_field() }} 
                <div class="form-group">
                  <label for="">Add Comment</label>
                  <textarea name="comment" class="form-control"  cols="30" rows="3"></textarea>
                </div>  
                <button type="submit" class="btn btn-primary">Add Comment</button>
                </form>
    @endif