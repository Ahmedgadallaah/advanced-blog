<?php
namespace App\Http\Controllers\BackEnd;
use App\Models\Comment;
use App\Http\Requests\BackEnd\Comments\Store;
trait CommentTrait{
    public function commentstore(Store $request){
        $requestArray = $request->all() + ['user_id' =>auth()->user()->id];
        
        Comment::create($requestArray);
       
        // return redirect()->back();
       
        return redirect()->route('videos.edit' , ['id' => $requestArray['video_id'] ,'#comments']);
    }

    public function commentDelete($id){
        
       $row= Comment::findOrfail($id);
       $row->delete();
       
        return redirect()->route('videos.edit' , ['id' => $row->video_id,'#comments' ]);
    }

    public function commentUpdate($id, Store $request){
        $row= Comment::findOrfail($id);

        $row->update($request->all());
        
         return redirect()->route('videos.edit' , ['id' => $row->video_id ,'#comments']);
     }
 
}