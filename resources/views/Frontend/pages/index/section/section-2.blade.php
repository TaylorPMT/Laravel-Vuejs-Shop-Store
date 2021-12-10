<section class="section home-2">
    <div class="container">
        <div class="wrap-title"> 
            <div class="section-title">Dịch vụ nhận hoa
                <div class="section-title-line">
                    <img class="lazyload" data-src="{{ asset('frontend/assets/img/title.png') }}" alt=""></div>
            </div>
        </div>
        <div class="wrap-product">
            <div class="row">
                @for($i = 1; $i < 4; $i++)
                <div class="col-md-4 col-sm-12">
                    <div class="block-product"> 
                        <a class="product-img zoom-out" href="">
                            <img class="lazyload" data-src="{{ asset('frontend/assets/img/flower/')}}/{{$i}}.jpg" alt="">
                        </a>
                        <div class="product-info">
                            <a class="product-info__title" href="">Gói sản phẩm {{$i}}</a>
                            <div class="product-info__detail">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Expedita delectus est labore fugit natus, similique atque rem nulla, vero laborum debitis aspernatur ratione animi, vitae sed nisi minima! Sunt, pariatur!</div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</section>