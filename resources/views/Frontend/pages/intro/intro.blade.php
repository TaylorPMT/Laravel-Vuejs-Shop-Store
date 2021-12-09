@extends('Frontend.fe-master')
@section('title', 'Giới thiệu')
@section('body-class', 'intro-page')
@section('content')
    @include('Frontend.main.pagebanner')
    @include('Frontend.main.breadcrumb')
    <section class="section section-introduce">
        <div class="container">
            <div class="wrap-title">
                <div class="section-title">Giới thiệu
                    <div class="section-title-line"><img class="lazyload" data-src="{{ asset('frontend/assets/img/title.png') }}" alt=""></div>
                </div>
            </div>
            <div class="wrap-content"></div>
        </div>
    </section>
@endsection