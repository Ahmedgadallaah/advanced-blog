<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Controllers\Controller;

class PagesController extends BackEndController
{
    
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'name' => ['required', 'string', 'max:191'],
            'des' =>['required', 'string', 'max:191'],
            'meta_keywords' => ['max:191'],
            'meta_des' => [ 'max:191'],
        ]);
        $this->model->create($request->all());

        return redirect()->route('pages.index');
    }

   

    public function update(Request $request, $id)
    { 
        $row = $this->model->FindOrFail($id);

        $this->validate($request,[

            'name' => ['required', 'string', 'max:191'],
            'meta_keywords' => ['max:191'],
            'meta_des' => [ 'max:191'],
        ]);
       
        
        $row->update($request->all());
        return redirect()->route('pages.edit',['id'=> $row->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function filter($rows){

        if(request()->has('name') && request()->get('name') !=""){
            $rows = $rows->where('name',request()->get('name')) ; 
           }
        return $rows;
    }

}
