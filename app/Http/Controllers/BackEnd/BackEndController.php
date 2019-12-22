<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\database\Eloquent\Model;

class BackEndController extends Controller
{
    protected $model;
    public function __construct(Model $model)
    {

        $this->model = $model;
    }


    protected function getClassNameFromModel()
    {
        return strtolower($this->pluralModelName());
    }



    public function index()
    {
        $rows = $this->model;
        $rows = $this->filter($rows);
        $with = $this->with();
        if(!empty ($with)){
        $rows = $rows->with($with);
        }
        $rows = $rows->paginate(10);

        $moduleName = $this->pluralModelName();
        $smoduleName = $this->getModelName();
        $routeName = $this->getClassNameFromModel();
        $pageTitle = $smoduleName . " Control";
        $pageDescription = "Here You Can  Add / Edit / Delete " . " " . $smoduleName;
       
        return view('back-end.' . $this->getClassNameFromModel() . '.index', compact(
            'rows',
            'moduleName',
            'smoduleName',
            'pageTitle',
            'pageDescription',
            'routeName'

        ));
    }

    public function create()
    {
        $moduleName = $this->pluralModelName();
        $smoduleName = $this->getModelName();
        $routeName = $this->getClassNameFromModel();
        $pageTitle = $smoduleName . " Control";
        $pageDescription = "Here You Can Add " . " " . $smoduleName;
        $append=$this->append();
        return view('back-end.' . $routeName . '.create', compact(
            'moduleName',
            'smoduleName',
            'pageTitle',
            'pageDescription',
            'routeName'
        ))->with($append);
    }

    public function edit($id)
    {
        $moduleName = $this->pluralModelName();
        $smoduleName = $this->getModelName();
        $routeName = $this->getClassNameFromModel();
        $pageTitle = $smoduleName . " Control";
        $pageDescription = "Here You Can Edit " . " " . $smoduleName;
        $rows = $this->model;
        $rows = $this->filter($rows);
        $row = $this->model->FindOrFail($id);
        $append = $this->append();
        return view('back-end.' . $this->getClassNameFromModel() . '.edit', compact(
            'row',
            'moduleName',
            'smoduleName',
            'pageTitle',
            'pageDescription',
            'routeName'
        ))->with($append);
    }

    public function destroy($id)
    {
        $row = $this->model->FindOrFail($id)->delete();
        return redirect()->route($this->getClassNameFromModel() . '.' . 'index');
    }


    protected function filter($rows)
    {
        return $rows;
    }

    protected function pluralModelName()
    {
        return str_plural(class_basename($this->model));
    }

    protected function getModelName()
    {
        return class_basename($this->model);
    }
    protected function with(){
        return [];
    }
    protected function append(){
        return [];
    }
}
