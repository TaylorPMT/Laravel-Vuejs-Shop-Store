@extends('Frontend.fe-master')
@section('title', 'Trang chủ')
@section('body-class', 'homepage')
@section('content')
    @include('Frontend.pages.index.banner.banner')


    @foreach ($block as $item)
        @include($item->block['path'],['block_data'=>$item->json_block,'block_data_item' =>json_decode($item->data_content)])
    @endforeach
    {{-- @include('Frontend.pages.index.section.section-1')
    @include('Frontend.pages.index.section.section-2')
    @include('Frontend.pages.index.section.section-3',['data'=>$category])
    @include('Frontend.pages.index.section.section-4',['news'=>$news])
    @include('Frontend.pages.index.section.section-5') --}}

@endsection
