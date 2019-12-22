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



    @include('back-end.'.$routeName.'.form')

</div>
@endcomponent
@endsection