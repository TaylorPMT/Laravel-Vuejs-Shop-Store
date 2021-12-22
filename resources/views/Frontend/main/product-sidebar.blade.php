<div class="wrapper-left">
    <div class="wrapper-left-list">
        <div class="list-head">Danh mục sản phẩm</div>
        <div class="list-body">
            <ul>
                @if (!empty($category) && count($category) > 0)
                    @foreach ($category as $item)
                        <li class=""><a
                                href="{{ route('frontend.product.category', ['url' => $item->link]) }}">{{ $item->name }}</a><em
                                class="material-icons">expand_more</em>
                            <ul class="cate-sub-menu">
                                @foreach ($item->productsCategory() as $product)
                                    <li> <a
                                            href="{{ route('frontend.product', ['url' => $product->link ?? $product->id]) }}">{{ $product->name }}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
