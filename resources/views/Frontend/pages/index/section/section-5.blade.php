<section class="section home-5">
    <div class="container"> 
        <div class="wrap-title"> 
            <div class="section-title">Bộ sưu tập
                <div class="section-title-line"><img class="lazyload" data-src="{{ asset('frontend/assets/img/title.png') }}" alt=""></div>
            </div>
        </div>
    </div>
    <div class="block-gallery">
        @for($i=1; $i < 7; $i++)
        <div class="gallery-item eye">
            <a class="zoom-out" href="{{ asset('frontend/assets/img/flower/')}}/{{$i}}.jpg" data-fancybox="Img" title="Album 1">
                <img class="lazyload" data-src="{{ asset('frontend/assets/img/flower/')}}/{{$i}}.jpg" alt="" title="">
            </a>
        </div>
        
        @endfor
    </div>
</section>