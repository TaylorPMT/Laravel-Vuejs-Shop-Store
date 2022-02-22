@if (!empty($block_data))
    <section class="section home-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="wrap-title">
                        <div class="section-title">{{ @$block_data['name'] }}
                            <div class="section-title-line">
                                <img class="lazyload" data-src="{{ asset('frontend/assets/img/title.png') }}"
                                    alt="" title="Symbols" width="50" height="50">
                            </div>
                        </div>
                    </div>
                    <div class="wrap-content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut magnam culpa, perspiciatis
                            architecto autem dolore sint non tempore obcaecati ullam odio, provident impedit commodi
                            porro exercitationem ratione maiores? Harum, facilis?</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil ullam vel neque veritatis
                            dignissimos! Reiciendis pariatur consectetur impedit nesciunt. Animi quibusdam, est quis ex
                            laborum assumenda culpa a odit asperiores.</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil ullam vel neque veritatis
                            dignissimos! Reiciendis pariatur consectetur impedit nesciunt. Animi quibusdam, est quis ex
                            laborum assumenda culpa a odit asperiores.</p>
                    </div>
                    <div class="wrap-button"><a class="btn btn-primary" href="">Xem thêm</a></div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="swiper-home-1">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="{{ asset('frontend/assets/img/flower/1.jpg') }}" data-fancybox="Img"
                                        title="Album 1">
                                        <img class="lazyload"
                                            data-src="{{ asset('frontend/assets/img/flower/1.jpg') }}" alt="" title=""
                                            width="600" height="420">
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="{{ asset('frontend/assets/img/flower/2.jpg') }}" data-fancybox="Img"
                                        title="Album 1">
                                        <img class="lazyload"
                                            data-src="{{ asset('frontend/assets/img/flower/2.jpg') }}" alt="" title=""
                                            width="600" height="420">
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="{{ asset('frontend/assets/img/flower/3.jpg') }}" data-fancybox="Img"
                                        title="Album 1">
                                        <img class="lazyload"
                                            data-src="{{ asset('frontend/assets/img/flower/3.jpg') }}" alt="" title=""
                                            width="600" height="420">
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="{{ asset('frontend/assets/img/flower/4.jpg') }}" data-fancybox="Img"
                                        title="Album 1">
                                        <img class="lazyload"
                                            data-src="{{ asset('frontend/assets/img/flower/4.jpg') }}" alt="" title=""
                                            width="600" height="420">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-navigation">
                            <div class="button-next"><em class="material-icons">east</em></div>
                            <div class="button-prev"><em class="material-icons">east</em></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
