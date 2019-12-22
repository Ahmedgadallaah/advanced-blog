@extends('back-end.layout.app')

@php
$moduleName="Video";
$pageTitle = $moduleName." Edit" ;
$pageDescription = "Here You Can Edit"." ".$moduleName;
@endphp

@section('title')
{{$pageTitle}}
@endsection



@section('content')
@component('back-end.layout.navbar')
@slot('nav_title')
Videos
@endslot


@endcomponent
@component('back-end.shared.edit',['pageTitle' => $pageTitle , 'pageDescription'=>$pageDescription])
<div class="card-body">

  <form action=" {{route($routeName.'.update',['id' => $row->id])}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    {{ method_field('put') }}
    @include('back-end.'.$routeName.'.form')
    <button type="submit" class="btn btn-primary pull-right">Update {{$moduleName}}</button>
    <div class="clearfix"></div>
  </form>
</div>
@slot('md4')
@php  $url = getYoutubeId($row->youtube) @endphp
@if($url)
<iframe width="300" height="315" src="https://www.youtube.com/embed/{{$url}}" frameborder="0"  allowfullscreen></iframe>
@endif
  <img src="{{url('uploads/'.$row->image) }}" width="300" >  
@endslot

@endcomponent

@php
$moduleName="Comment";
@endphp
@component('back-end.shared.edit',['pageTitle' => 'Comments' , 'pageDescription'=>'Here We can Control Comment'])



@include('back-end.comments.index')

  @slot('md4')

@include('back-end.comments.create')
@endslot
@endcomponent

 

@endsection