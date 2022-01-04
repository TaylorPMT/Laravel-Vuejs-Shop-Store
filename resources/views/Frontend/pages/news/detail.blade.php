@extends('Frontend.fe-master')
@section('title', 'Chi tiết tin tức')
@section('body-class', 'news-detail-page')
@section('content')
    @include('Frontend.main.breadcrumb')
    <section class="section section-detail-page">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-12 mx-auto">
                    <div class="section-title">{{ $data->name }}</div>
                    <div class="wrap-social text-left">
                        <div class="date"> <em class="material-icons">date_range</em>
                            <time>{{ convert_date($data->created_at) }}</time>
                        </div>
                    </div>
                    <div class="fullcontent">
                        {!! $data->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (!empty($data->news))
        <section class="news-related">
            <div class="container">
                <div class="wrap-title">
                    <div class="section-title">Tin tức liên quan
                        <div class="section-title-line"><img src="{{ asset('frontend/assets/img/title.png') }}"
                                alt="Symbols" title="Symbols"></div>
                    </div>
                </div>
                <div class="swiper-news-related">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($data->news->newsdetail(7, $data->id) as $item)
                                <div class="swiper-slide">
                                    <div class="wrap-news">
                                        <div class="newsimage"> <a class="img zoom-out"
                                                href="{{ route('frontend.news.detail', ['url' => $item->link]) }}"><img
                                                    class="lazyload" data-src="{{ asset($item->image[0] ?? '') }}"
                                                    alt="{{ $item->name }}"></a>
                                        </div>
                                        <div class="newsitem">
                                            <div class="date"> <em class="material-icons">date_range</em>
                                                <time>{{ convert_date($item->created_at) }}</time>
                                            </div>
                                            <div class="title text-uppercase"> <a
                                                    href="{{ route('frontend.news.detail', ['url' => $item->link]) }}">{!! $item->name !!}</a>
                                            </div>
                                            <div class="briefcontent">
                                                {!! $item->description !!}
                                            </div><a class="link-viewmore"
                                                href="{{ route('frontend.news.detail', ['url' => $item->link]) }}">
                                                <span>Xem chi tiết</span><em class="material-icons">trending_flat</em></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="swiper-navigation">
                        <div class="button-next"><em class="material-icons">east</em></div>
                        <div class="button-prev"><em class="material-icons">east</em></div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
