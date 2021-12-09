@extends('Frontend.fe-master')
@section('title', 'Thông tin liên hệ')
@section('body-class', 'contact-page')
@section('content')
    @include('Frontend.main.pagebanner')
    @include('Frontend.main.breadcrumb')

    <section class="section section-contact">
        <div class="container">
            <div class="wrap-title">
                <div class="section-title">Liên hệ
                    <div class="section-title-line"><img class="lazyload" data-src="{{ asset('frontend/assets/img/title.png') }}" alt=""></div>
                </div>
            </div>
            <div class="wrap-contact text-center">
                <div class="wrap-contact__avatar"> 
                    <div class="img"> <img src="{{ asset('frontend/assets/img/avatar.png') }}" alt=""></div>
                    <div class="title"> <span>Florist:</span><span>Nguyễn Văn Sơn</span></div>
                </div>
                <div class="wrap-contact__body"> 
                    <div class="contact--item"> 
                        <div class="icon"><em class="material-icons-outlined">phone</em></div>
                        <div class="text"><strong>Số điện thoại:&nbsp;</strong><a href="tel:0123456789">0123456789</a></div>
                    </div>
                    <div class="contact--item"> 
                        <div class="icon"><em class="fab fa-facebook-f"></em></div>
                        <div class="text"><strong> Facebook:&nbsp;</strong><a href="https://www.facebook.com/">https://www.facebook.com/</a></div>
                    </div>
                    <div class="contact--item"> 
                        <div class="icon"><em class="zalo">Z</em></div>
                        <div class="text"><strong>Zalo:&nbsp;</strong><a href="https://www.facebook.com/">https://www.facebook.com/</a></div>
                    </div>
                </div>
                <div class="wrap-contact__note"> 
                    <p>* Mọi vấn đề thắc mắc về hoa quý khách có thể liên hệ để được tư vấn trực tiếp. Cảm ơn quý khách đã ghé ủng hộ!</p>
                </div>
            </div>
        </div>
    </section>

@endsection