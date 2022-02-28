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
                    @php
                          $html = "";
                        foreach ($block_data_item as $item) {
                            $productImage = asset($item->image[0] ?? 'default');
                            $productName = $item->name;
                            $productSlug = route('frontend.product', ['url' => $item->link]);
                            $productContent = $item->description;
                            $html .= "
                            <div class=\"col-md-4 col-sm-12\">
                                    <div class=\"block-product\">
                                            <a class=\"product-img zoom-out\" href=\"$productSlug\">
                                                <img class=\"lazyload\"
                                                    data-src=\"$productImage\"
                                                    alt=\"\" width=\"390\" height=\"507\">
                                            </a>
                                            <div class=\"product-info\">
                                                <a class=\"product-info__title\" href=\"$productSlug\">$productName</a>
                                                <div class=\"product-info__detail\">$productContent</div>
                                            </div>
                                    </div>
                            </div> ";
                        }
                        $html .= "";
                    @endphp
                    {!! $html !!}
                </div>
            </div>
        </div>
    </section>
@endif
