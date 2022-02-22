@extends('Frontend.fe-master')
@section('title', 'Kết quả tìm kiếm')
@section('body-class', 'result-page')
@section('content')
    @include('Frontend.main.pagebanner')
    <section class="section section-result">
        <div class="container">
            <h1>Kết quả tìm kiếm cho từ khóa: {{ request()->get('key_word') }}</h1>
            <div class="row">
                @if (!empty($data))
                    @foreach ($data as $item)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="block-product"> <a class="product-img zoom-out" href="{{ $item->view_link }}"><img
                                        src="{{ asset($item->image) }}" alt=""></a>
                                <div class="product-info"><a class="product-info__title"
                                        href="{{ $item->view_link }}">{{ $item->name }}</a></div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>


@endsection
