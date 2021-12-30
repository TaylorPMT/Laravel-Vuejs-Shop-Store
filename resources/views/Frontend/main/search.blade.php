@extends('Frontend.fe-master')
@section('title', 'Kết quả tìm kiếm')
@section('body-class', 'result-page')
@section('content')
    @include('Frontend.main.pagebanner')
    <section class="section section-result">
        <div class="container"> 
            <h1>Kết quả tìm kiếm cho từ khóa: Hoaaa</h1>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="block-product"> <a class="product-img zoom-out" href=""><img src="./img/flower/1.jpg" alt=""></a>
                        <div class="product-info"><a class="product-info__title" href="">Sản phẩm 1</a></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="block-product"> <a class="product-img zoom-out" href=""><img src="./img/flower/2.jpg" alt=""></a>
                        <div class="product-info"><a class="product-info__title" href="">Sản phẩm 2</a></div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


@endsection