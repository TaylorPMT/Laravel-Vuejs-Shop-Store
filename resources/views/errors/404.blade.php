@extends('Frontend.fe-master')
@section('title', 'Không tìm thấy trang')
@section('body-class', 'error-page')
@section('content')
    @include('Frontend.main.pagebanner')
    <section class="section section-error">
        <div class="container">
            <div class="wrapper text-center">
                <h1>Không tìm thấy trang </h1>
                <p>Xin lỗi, chúng tôi không tìm thấy trang này</p><a class="back-home" href=""> <em
                        class="material-icons">west</em><span>Trở về trang chủ</span></a>
            </div>
        </div>
    </section>


@endsection
