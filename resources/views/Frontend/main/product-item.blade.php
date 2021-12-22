@if (!empty($item))
    @php
        $route = route('frontend.product', ['url' => $item->link ?? $item->id]);
    @endphp
    <div class="block-product">
        <a class="product-img zoom-out" href="{{ $route }}">
            <img class="lazyload" data-src="{{ asset(current($item->image)) }}" alt="{{ $item->link }}"
                title="{{ $item->name }}}">
        </a>
        <div class="product-info">
            <a class="product-info__title" href="{{ $route }}" title="{{ $item->name }}">{{ $item->name }}</a>
        </div>
    </div>
@endif
