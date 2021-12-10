@extends('Frontend.fe-master')
@section('title', 'Danh sách sản phẩm')
@section('body-class', 'page-list-product')
@section('content')
    @include('Frontend.main.pagebanner')
    @include('Frontend.main.breadcrumb')

    <section class="section section-list-product">
        <div class="container"> 
            <div class="wrap-title"> 
                <div class="section-title">Tất cả sản phẩm
                    <div class="section-title-line"><img src="./img/title.png" alt=""></div>
                </div>
            </div>
            <div class="row"> 
                <div class="col-lg-3 col-md-12"> 
                    @include('Frontend.main.product-sidebar')
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="wrapper-right">
                        <div class="row">
                            @for($i=1; $i < 13; $i++)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                @include('Frontend.main.product-item') 
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection