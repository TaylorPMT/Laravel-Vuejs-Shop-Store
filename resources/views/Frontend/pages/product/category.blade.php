@extends('Frontend.fe-master')
@section('title', 'Danh sách sản phẩm')
@section('body-class', 'page-list-product')
@section('content')
    @include('Frontend.main.pagebanner')
    @include('Frontend.main.breadcrumb')
    <section class="section section-list-product">
        <div class="container">
            <div class="wrap-title">
                <div class="section-title">{{ $data->name }}
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
                            @foreach ($data->products as $item)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    @include('Frontend.main.product-item')
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @include('Frontend.main.paginate',[
                    'paginator' => $data->products
                    ])
                </div>
            </div>



        </div>
    </section>

@endsection
