<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;

use App\Models\Video;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Tag;

class VideosController extends BackEndController
{
    use CommentTrait;
    public function __construct(Video $model)
    {
        parent::__construct($model);
    }

  protected function with(){
      return ['cat','user'];
  }
  protected function append(){
    $array = [
        'categories' => Category::get(),
        'skills' => skill::get(),
        'tags' => Tag::get(),
        'selectedSkills'=>[],
        'selectedTags'=>[],
        'comments' =>[]
    ];
        if(request()->route()->parameter('video')){
$array['selectedSkills'] = $this->model->find(request()->route()->parameter('video'))
            ->skills()->pluck('skills.id')->toArray();
        }

        if(request()->route()->parameter('video')){
            $array['selectedTags'] = $this->model->find(request()->route()->parameter('video'))
                        ->tags()->pluck('tags.id')->toArray();
                    }

        if(request()->route()->parameter('video')){
            $array['comments'] = $this->model->find(request()->route()->parameter('video'))
            ->comments()->orderBy('id','desc')->with('user')->get();
          }

        
        return $array;
    }

   
 
    public function store(Request $request)
    {
        $this->validate($request,[

            'name' => ['required', 'string', 'max:191'],
            'des' =>['required', 'string','min:10', 'max:191'],
            'meta_keywords' => ['max:191'],
            'meta_des' => [ 'max:191'],
            'youtube' => ['required', 'string','min:10'],
            'cat_id' =>['required', 'integer' ],
            'published' => [ 'required'],
            'image' => [ 'required','image'],
        ]); 

        $fileName =$this->uploadImage($request);
        $requestArray = ['user_id' => auth()->user()->id, 'image'=> $fileName] + $request->all() ;
        $row = $this->model->create($requestArray);

        $this->syncTagsSkills($row,$requestArray);
      
       
    
        return redirect()->route('videos.index');
    }
    public function update(Request $request, $id)
    { 
        
        $this->validate($request,[

            'name' => ['required', 'string', 'max:191'],
            'des' =>['required', 'string','min:10', 'max:191'],
            'meta_keywords' => ['max:191'],
            'meta_des' => [ 'max:191'],
            'youtube' => ['required', 'string','min:10'],
            'cat_id' =>['required', 'integer' ],
            'published' => [ 'required'],
        ]);
        $requestArray = $request->all();

        if($request->hasFile('image')){
            $fileName =$this->uploadImage($request);
            $requestArray = [ 'image'=> $fileName] + $requestArray ;
        }
        $row = $this->model->FindOrFail($id);
        
        $row->update($requestArray);
        $this->syncTagsSkills($row,$requestArray);
        
       
        return redirect()->route('videos.edit',['id'=> $row->id]);
    }

    
    protected function filter($rows){

        if(request()->has('name') && request()->get('name') !=""){
            $rows = $rows->where('name',request()->get('name')) ; 
           }
        return $rows;
    }

        protected function syncTagsSkills($row,$requestArray){
  
            if(isset($requestArray['skills']) && !empty($requestArray['skills'])){
                $row->skills()->sync($requestArray['skills']);
            }
    
            if(isset($requestArray['tags']) && !empty($requestArray['tags'])){
                $row->tags()->sync($requestArray['tags']);
            }
        }

        protected function uploadImage($request){
            
            $file = $request->file('image');
            $fileName=time().\str_random('10').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'),$fileName);
        return $fileName;
        }
        
}
