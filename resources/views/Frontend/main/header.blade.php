@php
$repo = app(\CMS\Frontend\Repository\FrontendRepository::class);
$menu = $repo->menus();
@endphp
<header>
    <div class="header">
        <div class="container">
            <div class="wrap-header">
                <div class="hamburger-menu"><span></span></div>
                <div class="logo"><a class="img" href="/" title="Trang chủ"><img
                            class="lazyload" data-src="{{ asset('frontend/assets/img/logo-main.jpg') }}"
                            alt="Logo" title="Sơn Boutique"></a></div>
                <div class="wrap-menu">
                    <ul class="primary-menu">
                        @foreach ($menu as $item)
                            @if (count($item->category_id) == 0)
                                <li>
                                    <div class="title"> <a href="{{ $item->link }}">{{ $item->name }}</a>
                                    </div>
                                </li>
                            @else
                                <li class="dropdown">
                                    <div class="title"><a>{{ $item->name }}</a></div>
                                    @foreach ($item->categorys($item) as $category)
                                        <ul class="sub-menu">
                                            @php
                                                $url = !empty($category->url) ? route('frontend.product.category', ['url' => $category->url]) : route('frontend.product.category', ['url' => $category->id]);
                                            @endphp
                                            <li>
                                                <div class="title"><a
                                                        href="{{ $url }}">{{ $category->name }}</a>
                                                </div>
                                            </li>
                                        </ul>
                                    @endforeach
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="wrap-right">
                    <div class="language d-none"><a href="">en </a><em class="material-icons">arrow_drop_down</em>
                        <div class="language-dropdown"><a class="language__item">vn</a></div>
                    </div>
                    <div class="search"> <em class="material-icons">search</em></div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap-search">
        <div class="searchbox">
            <input placeholder="Tìm Kiếm">
            <button class="btn-search"><em class="material-icons">search</em></button>
        </div>
    </div>
    <div class="wrap-menu-mb"></div>
</header>
