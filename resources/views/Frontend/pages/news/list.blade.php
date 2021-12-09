@extends('Frontend.fe-master')
@section('title', 'Danh sách tin tức')
@section('body-class', 'news-page')
@section('content')
    @include('Frontend.main.pagebanner')
    @include('Frontend.main.breadcrumb')

    <section class="section section-news">
        <div class="container-fluid">
            <div class="wrap-title"> 
                <div class="section-title">Tin tức
                    <div class="section-title-line"><img class="lazyload" data-src="{{ asset('frontend/assets/img/title.png') }}" alt=""></div>
                </div>
            </div>
            <div class="list-news">
                <div class="list-news--container">

                    @for($i = 20; $i < 25; $i++)
                    <div class="row">
                        <div class="col-md-7"></div>
                        <div class="col-lg-5 col-md-12 col-sm-6 col-12">
                            <div class="news-item">
                                <div class="line"></div>
                                <div class="news__img"> 
                                    <a class="img" href="">
                                        <img class="lazyload" data-src="{{ asset('frontend/assets/img/flower/')}}/{{$i}}.jpg" alt="" title="">
                                    </a>
                                </div>
                                <div class="news__content">
                                    <div class="news__content-title"> <a href="">Tin tức {{$i}}</a></div>
                                    <div class="news__content-date"> 
                                        <time>09/11/1998</time>
                                    </div>
                                    <div class="news__content-description"> 
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque eum, accusamus cumque ratione, provident molestias non minus sunt est ab odio voluptates vel. Rerum voluptates ullam suscipit possimus inventore veniam?</p>
                                    </div>
                                    <div class="news__content-seemore"><a href=""> <span>Xem chi tiết</span><em class="material-icons">trending_flat</em></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>

@endsection