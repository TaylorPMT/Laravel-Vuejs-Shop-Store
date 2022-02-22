@foreach ($data as $category)
    <section class="section home-3">
        <div class="container">
            <div class="wrap-title">
                <div class="section-title">{{ $category->name }}
                    <div class="section-title-line">
                        <img class="lazyload" data-src="{{ asset('frontend/assets/img/title.png') }}"
                            alt="Symbols" title="Symbols" width="50" height="50">
                    </div>
                </div>
            </div>
            <div class="swiper-home-2">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($category->products as $item)
                            <div class="swiper-slide">
                                @include('Frontend.main.product-item')
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-navigation">
                    <div class="button-next"><em class="material-icons">east</em></div>
                    <div class="button-prev"><em class="material-icons">east</em></div>
                </div>
                <div class="wrap-button"> <a class="btn btn-primary" href="">Xem thêm</a></div>
            </div>
        </div>
    </section>
@endforeach
