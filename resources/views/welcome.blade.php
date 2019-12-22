@extends('layouts.app')

@section('title' ,'Home Page')
@section('content')
@include('front-end.homepage-sections.home-image') 
@include('front-end.homepage-sections.Videos')
@include('front-end.homepage-sections.statics')
@include('front-end.homepage-sections.contact-us')
@endsection

