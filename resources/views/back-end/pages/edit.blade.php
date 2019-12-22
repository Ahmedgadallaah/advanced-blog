@extends('back-end.layout.app')

@php
$moduleName="Page";
$pageTitle = $moduleName." Edit" ;
$pageDescription = "Here You Can Edit"." ".$moduleName;
@endphp

@section('title')
{{$pageTitle}}
@endsection

@section('content')
@component('back-end.layout.navbar')
@slot('nav_title')
Pages
@endslot


@endcomponent
@component('back-end.shared.edit',['pageTitle' => $pageTitle , 'pageDescription'=>$pageDescription])
<div class="card-body">

  <form action=" {{route($routeName.'.update',['id' => $row->id])}}" method="POST">
    {{csrf_field()}}
    {{ method_field('put') }}
    @include('back-end.'.$routeName.'.form')
    <button type="submit" class="btn btn-primary pull-right">Update {{$moduleName}}</button>
    <div class="clearfix"></div>
  </form>
</div>
@endcomponent
@endsection