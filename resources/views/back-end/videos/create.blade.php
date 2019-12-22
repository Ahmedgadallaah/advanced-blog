@extends('back-end.layout.app')



@section('title')
{{$pageTitle}}
@endsection

@section('content')
@component('back-end.layout.navbar')
@slot('nav_title')
Videos
@endslot


@endcomponent


@component('back-end.shared.create',['pageTitle' => $pageTitle , 'pageDescription' => $pageDescription ])

<div class="card-body">

  <form action=" {{route($routeName.'.store')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    @include('back-end.'.$routeName.'.form')
    <button type="submit" class="btn btn-primary pull-right">ADD {{$moduleName}}</button>
    <div class="clearfix"></div>
  </form>
</div>

@endcomponent

@endsection