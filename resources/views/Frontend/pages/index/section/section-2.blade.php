@if (!empty($block_data))
    <section class="section home-2">
        <div class="container">
            <div class="wrap-title">
                <div class="section-title">{{ $block_data['name'] }}
                    <div class="section-title-line">
                        <img class="lazyload" data-src="{{ asset('frontend/assets/img/title.png') }}" alt=""
                            width="50" height="50">
                    </div>
                </div>
            </div>
            <div class="wrap-product">
                <div class="row">
                    {!! $block_data_item !!}
                </div>
            </div>
        </div>
    </section>
@endif
