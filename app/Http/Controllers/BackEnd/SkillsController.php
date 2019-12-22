<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\Skill;
class SkillsController extends BackEndController
{
    public function __construct(Skill $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:191'],
        ]);
        $this->model->create($request->all());

        return redirect()->route('skills.index');
    }

   

    public function update(Request $request, $id)
    { 
        $row = $this->model->FindOrFail($id);

        $this->validate($request,[

            'name' => ['required', 'string', 'max:191'],
        ]);
       
        
        $row->update($request->all());
        return redirect()->route('skills.edit',['id'=> $row->id]);
    }



    protected function filter($rows){

        if(request()->has('name') && request()->get('name') !=""){
            $rows = $rows->where('name',request()->get('name')) ; 
           }
        return $rows;
    }

}
