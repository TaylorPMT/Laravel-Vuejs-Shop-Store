@extends('Frontend.fe-master')
@section('title', 'Trang chủ')
@section('body-class', 'homepage')
@section('content')
    @include('Frontend.pages.index.banner.banner')
    @include('Frontend.pages.index.section.section-1')
    @include('Frontend.pages.index.section.section-2')
    @include('Frontend.pages.index.section.section-3',['data'=>$category])
    @include('Frontend.pages.index.section.section-4',['news'=>$news])
    @include('Frontend.pages.index.section.section-5')

@endsection
