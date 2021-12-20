@extends('Frontend.fe-master')
@section('title', 'Bộ sưu tập')
@section('body-class', 'gallery-page')
@section('content')
    @include('Frontend.main.pagebanner')
    @include('Frontend.main.breadcrumb')

    <section class="section section-gallery">
        <div class="container">
            <div class="wrap-title">
                <div class="section-title">Bộ sưu tập
                    <div class="section-title-line"><img class="lazyload"
                            data-src="{{ asset('frontend/assets/img/title.png') }}" alt="Symbols" title="Symbols"></div>
                </div>
            </div>
            <div class="wrap-gallery">
                <div class="row">
                    @foreach ($data as $item)
                        @if (!empty($item->image))
                            @foreach ($item->image as $subImage)
                                <div class="col-lg-3 col-md-3 col-sm-6">

                                    <a class="gallery-item" href="{{ asset(current($item->image)) }}"
                                        data-fancybox="Img">

                                        <div class="img zoom-out">
                                            <img class="lazyload" data-src="{{ asset($subImage) }}"
                                                alt="{{ $subImage }}" title="{{ $subImage }}">
                                        </div>

                                        <div class="title">{{ $item->name }}</div>
                                        <div class="inner-action">
                                            <em class="material-icons">collections</em>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
