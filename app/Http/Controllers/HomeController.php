<?php

namespace App\Http\Controllers;
use App\Models\Video;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only([
            'commentUpdate','commentStore','profileUpdate'
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $videos = Video::OrderBy('id','desc');
        if(request()->has('search') && request()->get('search') !=''){
            $videos = $videos->where('name','like','%'.request()->get('search').'%');
        }
        $videos = $videos->paginate(30); 
        return view('home',compact('videos'));
    }

    public function category($id)
    {
        $cat=Category::findOrFail($id);
        $videos = Video::where('cat_id', $id)->orderBy('id','desc')->paginate(30); 
        return view('front-end.category.index',compact('videos','cat'));
    }

    public function video($id)
    {
        $video=Video::with('skills','tags','cat','user','comments.user')->findOrFail($id);
        return view('front-end.video.index',compact('video'));
    }

    public function skill($id)
    {
        $skill=Skill::findOrFail($id);
        $videos = Video::whereHas('skills', function($query) use($id){

            $query->where('skill_id',$id);

        })->orderBy('id','desc')->paginate(30); 
        return view('front-end.skill.index',compact('videos','skill'));
    }

    public function tag($id)
    {
        $tag=Tag::findOrFail($id);
        $videos = Video::whereHas('tags', function($query) use($id){

            $query->where('tag_id',$id);

        })->orderBy('id','desc')->paginate(30); 
        return view('front-end.tag.index',compact('videos','tag'));
    }

    public function commentUpdate($id, Request $request){
        $comment = Comment::findOrFail($id);
        if(($comment->user_id == auth()->user()->id) || (auth()->user()->group == 'admin')){
            $this->validate($request,[
                'comment' => ['required', 'min:10', 'max:2000'],
            ]);

            $comment->update(['comment' =>$request->comment]);
        }
        return redirect()->route('frontend.video' , ['id' => $comment->video_id , "#comments"]);
    }

    public function commentStore($id, Request $request){
        $video = Video::findOrFail($id);
        Comment::create([
            'user_id' => auth()->user()->id,
            'video_id' => $video->id,
            'comment' => $request->comment
        ]);
        return redirect()->route('frontend.video' , ['id' => $video->id , "#comments"]);
    }

    public function messageStore( Request $request){
        
        $this->validate($request,[
            'name' => ['required', 'string','min:3', 'max:191'],
            'email' => ['required','email','min:10', 'max:191'],
            'message' => ['required','min:10', 'max:500'],
        ]);
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);
        return redirect()->route('frontend.landing');
    }
    
public function welcome(){
    $videos = Video::OrderBy('id','desc')->paginate(9);
    $videos_Count = Video::count();
    $comments_Count = Comment::count();
    $tags_Count = Tag::count();
    return view('welcome' , compact('videos','videos_Count','comments_Count','tags_Count'));
}

public function page ($id, $slug = null){
    $page = Page::findOrFail($id);
    return view('front-end.page.index' , compact('page'));
}

public function profile($id, $slug = null){
    $user = User::findOrFail($id);
    return view('front-end.profile.index' , compact('user'));
}

public function profileUpdate(Request $request ){
    $user = User::findOrFail(auth()->user()->id);
    $array=[];

        
        if($request->email != $user->email ){
            $email = User::where('email', $request->email)->first();
            
            if($email == null){
            $array['email'] = $request->email;
        }
    }
        if($request->name != $user->name ){
            $array['name'] = $request->name;
        }
        if($request->password != '' ){
            $array['password'] =Hash::make( $request->password);
        }

        if(!empty($array)){
            $user->update($array);
        }
        
        return redirect()->route('front.profile' , [ 'id'=> $user->id , 'slug' => slug($user->name) ]);
   
}

}
