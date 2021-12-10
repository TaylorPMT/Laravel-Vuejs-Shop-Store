@extends('Frontend.fe-master')
@section('title', 'Chi tiết sản phẩm')
@section('body-class', 'page-detail-product')
@section('content')
    @include('Frontend.main.breadcrumb')

    <section class="section page-detail-product"> 
        <div class="container">
            <div class="wrapper-top">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="wrapper-img"> 
                            <div class="swiper-big-img">
                                <div class="swiper-container"> 
                                    <div class="swiper-wrapper">
                                        @for ($i=1; $i < 7; $i++)
                                        <div class="swiper-slide">
                                            <a class="img" href="{{ asset('frontend/assets/img/flower/')}}/{{$i}}.jpg" data-fancybox="Img" title="Album 1"> 
                                                <img src="{{ asset('frontend/assets/img/flower/')}}/{{$i}}.jpg" alt="">
                                            </a>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-thumb-img">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper"> 
                                        @for ($i=1; $i < 7; $i++)
                                        <div class="swiper-slide">
                                            <div class="img"> <img src="{{ asset('frontend/assets/img/flower/')}}/{{$i}}.jpg" alt=""></div>
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
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="wrapper-detail-product">
                            <div class="detail-product__title">Hoa phong cảnh để trưng</div>
                            <div class="detail-product__sku">SKU123456</div>
                            <div class="detail-product__price"> <span>Liên hệ</span></div>
                            <div class="detail-product__description"> 
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam quasi eveniet laudantium deleniti vero omnis nemo doloremque ducimus eius, nisi, accusantium dolores unde repellat itaque minima mollitia odit optio sint. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ut nisi doloremque sint quis similique harum sit excepturi atque unde iste. Soluta veniam cum doloribus repudiandae reiciendis nam perspiciatis voluptates porro?</p>
                            </div>
                            <div class="detail-product__sharing">
                                <div class="sharing-item"><a href="">Facebook </a></div>
                                <div class="sharing-item"><a href="">Zalo</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper-bottom"> 
                <ul class="block__tab">
                    <li class="active"><a data-content="content-1">Mô tả</a></li>
                    <li><a data-content="content-2">Hướng dẫn chăm sóc</a></li>
                </ul>
                <div class="block__content"> 
                    <ul class="active" id="content-1"> 
                        <li> 
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus ab iusto dolorum aperiam reiciendis vero sunt quidem porro doloremque! Repellat voluptatibus debitis quis possimus iste sunt repudiandae ipsa minima dolore.</p>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus ab iusto dolorum aperiam reiciendis vero sunt quidem porro doloremque! Repellat voluptatibus debitis quis possimus iste sunt repudiandae ipsa minima dolore.</p>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus ab iusto dolorum aperiam reiciendis vero sunt quidem porro doloremque! Repellat voluptatibus debitis quis possimus iste sunt repudiandae ipsa minima dolore.</p>
                        </li>
                    </ul>
                    <ul id="content-2"> 
                        <li> 
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus ab iusto dolorum aperiam reiciendis vero sunt quidem porro doloremque! Repellat voluptatibus debitis quis possimus iste sunt repudiandae ipsa minima dolore. 2</p>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus ab iusto dolorum aperiam reiciendis vero sunt quidem porro doloremque! Repellat voluptatibus debitis quis possimus iste sunt repudiandae ipsa minima dolore. 2</p>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus ab iusto dolorum aperiam reiciendis vero sunt quidem porro doloremque! Repellat voluptatibus debitis quis possimus iste sunt repudiandae ipsa minima dolore. 2 </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @include('Frontend.pages.product.product-related')

@endsection