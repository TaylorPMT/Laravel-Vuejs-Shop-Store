<section class="section product-related">
    <div class="container">
        <div class="wrap-title">
            <div class="section-title">Sản phẩm liên quan
                <div class="section-title-line"><img class="lazyload"
                        data-src="{{ asset('frontend/assets/img/title.png') }}" alt=""></div>
            </div>
            <div class="swiper-related">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($data->category->ProductsCategory() as $item)
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
            </div>
        </div>
    </div>
</section>
