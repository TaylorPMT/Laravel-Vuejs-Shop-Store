@extends('Frontend.fe-master')
@section('title', 'Chi tiết tin tức')
@section('body-class', 'news-detail-page')
@section('content')
    @include('Frontend.main.breadcrumb')
    <section class="section section-detail-page">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-12 mx-auto">
                    <div class="section-title">Vietnam Ching Luh was awarded 2016 top 100 sustainable business in Vietnam</div>
                    <div class="wrap-social text-left">
                        <div class="date"> <em class="material-icons">date_range</em>
                            <time>March, 15, 2021</time>
                        </div>
                    </div>
                    <div class="fullcontent">
                        <p>Vietnam Ching Luh has received Top 100 Sustainable Business Award in Vietnam 2016 launched by Vietnam Chamber of Commerce and Industry (VCCI) in Hanoi on November 8. Ching Luh Global OS Head Steve Lee was on behalf of the company to receive the award.</p><img class="lazyload" data-src="{{ asset('frontend/assets/img/news/2.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <secion class="news-related">
        <div class="container">
            <div class="wrap-title"> 
                <div class="section-title">Tin tức liên quan
                    <div class="section-title-line"><img src="{{ asset('frontend/assets/img/title.png') }}" alt="Symbols" title="Symbols"></div>
                </div>
            </div>
            <div class="swiper-news-related"> 
                <div class="swiper-container"> 
                    <div class="swiper-wrapper"> 
                        @for ($i=1; $i < 7; $i++)
                        <div class="swiper-slide"> 
                            <div class="wrap-news"> 
                                <div class="newsimage"> <a class="img zoom-out" href=""><img class="lazyload" data-src="{{ asset('frontend/assets/img/flower/')}}/{{$i}}.jpg" alt=""></a></div>
                                <div class="newsitem"> 
                                    <div class="date"> <em class="material-icons">date_range</em>
                                        <time>March, 15, 2021</time>
                                    </div>
                                    <div class="title text-uppercase"> <a href="">OUR COMMUNITY “LIFT AS WE RISE”</a></div>
                                    <div class="briefcontent"> 
                                        <p>Dear Colleagues: Happy New Year! Time flies. As the New Year 2018 begins, let us also start anew. When the New Year comes, everyone joyfully welcomes the New Year, and congratulates to each other in the New Year moments, I, on behalf of the Management Board, like to send the New Year greetings to all of you and thanks for your hard work over the past year.</p>
                                    </div><a class="link-viewmore" href=""> <span>Xem chi tiết</span><em class="material-icons">trending_flat</em></a>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                <div class="swiper-navigation"> 
                    <div class="button-next"><em class="material-icons">east</em></div>
                    <div class="button-prev"><em class="material-icons">east</em></div>
                </div>
            </div>
        </div>
    </secion>
@endsection