<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoriesController extends BackEndController
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'name' => ['required', 'string', 'max:191'],
            'meta_keywords' => ['max:191'],
            'meta_des' => [ 'max:191'],
        ]);
        $this->model->create($request->all());

        return redirect()->route('categories.index');
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
        return redirect()->route('categories.edit',['id'=> $row->id]);
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
