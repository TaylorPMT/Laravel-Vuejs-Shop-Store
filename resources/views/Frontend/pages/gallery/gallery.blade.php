@extends('Frontend.fe-master')
@section('title', 'Bộ sưu tập')
@section('body-class', 'gallery-page')
@section('content')
    @include('Frontend.main.pagebanner')
    @include('Frontend.main.breadcrumb')
    
    <section class="section section-gallery">
        <div class="container">
            <div class="wrap-title">
                <div class="section-title">Bộ sưu tập
                    <div class="section-title-line"><img class="lazyload" data-src="{{ asset('frontend/assets/img/title.png') }}" alt="Symbols" title="Symbols"></div>
                </div>
            </div>
            <div class="wrap-gallery">
                <div class="row">
                @for($i=1; $i < 13; $i++)
                    <div class="col-lg-3 col-md-3 col-sm-6"> 
                        <a class="gallery-item" href="{{ asset('frontend/assets/img/flower/')}}/{{$i}}.jpg" data-fancybox="Img">
                            <div class="img zoom-out">
                                <img class="lazyload" data-src="{{ asset('frontend/assets/img/flower/')}}/{{$i}}.jpg" alt="" title="">
                            </div>
                            <div class="title">Bộ sưu tập {{$i}}</div>
                            <div class="inner-action">
                                <em class="material-icons">collections</em>
                            </div>
                        </a>
                    </div>
                @endfor
                </div>
            </div>
        </div>
    </section>
@endsection