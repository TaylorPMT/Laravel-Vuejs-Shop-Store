<section class="section home-4">
    <div class="container">
        <div class="wrap-title">
            <div class="section-title">Tin tức
                <div class="section-title-line"><img class="lazyload" data-src="{{ asset('frontend/assets/img/title.png') }}" alt="Symbol" title="Symbol"></div>
            </div>
        </div>
        <div class="wrap-news"> 
            <div class="row"> 
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 box-left">
                    <div class="news-item lg-item">
                        <div class="news-item__image"> <a href=""><img src="{{ asset('frontend/assets/img/flower/1.jpg') }}" alt=""></a></div>
                        <div class="news-item__detail"> 
                            <div class="title"> <a href="">Tin tức 1</a></div>
                            <div class="date">12/08/2021</div>
                            <div class="content">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam minima, deleniti pariatur, aspernatur ut quibusdam molestiae nesciunt natus optio inventore quis voluptatibus eaque a quas, ad quia doloremque adipisci aliquid?</div>
                            <div class="seemore"> <a href=""> <span>Xem chi tiết</span><em class="material-icons">east</em></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 box-right">
                    <div class="row">
                        @for($i=2; $i < 6; $i++)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="news-item sm-item">
                                <div class="news-item__image"> <a href=""><img class="lazyload" data-src="{{ asset('frontend/assets/img/flower/')}}/{{$i}}.jpg" alt="" title=""></a></div>
                                <div class="news-item__detail"> 
                                    <div class="title"> <a href="">Tin tức {{$i}}</a></div>
                                    <div class="date"> 
                                        <time>12/08/2021</time>
                                    </div>
                                    <div class="content">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam minima, deleniti pariatur, aspernatur ut quibusdam molestiae nesciunt natus optio inventore quis voluptatibus eaque a quas, ad quia doloremque adipisci aliquid?</div>
                                    <div class="seemore"> <a href=""> <span>Xem chi tiết</span><em class="material-icons">east</em></a></div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap-button"> <a class="btn btn-primary" href="">Xem thêm</a></div>
    </div>
</section>