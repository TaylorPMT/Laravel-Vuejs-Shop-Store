@if (!empty($news))
    @php
        $first_record = $news[0] ?? '';
    @endphp
    <section class="section home-4">
        <div class="container">
            <div class="wrap-title">
                <div class="section-title">Tin tức
                    <div class="section-title-line"><img class="lazyload"
                            data-src="{{ asset('frontend/assets/img/title.png') }}" alt="Symbol" title="Symbol"
                            width="50" height="50"></div>
                </div>
            </div>
            <div class="wrap-news">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 box-left">
                        @if (!empty($first_record))
                            <div class="news-item lg-item">
                                <div class="news-item__image"> <a
                                        href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}"><img
                                            src="{{ asset($first_record->image[0] ?? '') }}"
                                            alt="{{ $first_record->link }}"></a></div>
                                <div class="news-item__detail">
                                    <div class="title"> <a
                                            href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}">{{ $first_record->name }}</a>
                                    </div>
                                    <div class="date">{{ convert_date($first_record->created_at) }}</div>
                                    <div class="content">{!! $first_record->description !!}
                                    </div>
                                    <div class="seemore"> <a
                                            href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}">
                                            <span>Xem chi tiết</span><em class="material-icons">east</em></a></div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 box-right">
                        <div class="row">
                            @if (count($news) > 2 && !empty($news))
                                @foreach (collect($news)->slice(1) as $item)
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="news-item sm-item">
                                            <div class="news-item__image"> <a
                                                    href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}">
                                                    <img class="lazyload"
                                                        data-src="{{ asset($item->image[0] ?? '') }}" alt="" title=""
                                                        width="285" height="223"></a>
                                            </div>
                                            <div class="news-item__detail">
                                                <div class="title"> <a
                                                        href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}">{{ @$item->name }}</a>
                                                </div>
                                                <div class="date">
                                                    <time>{{ convert_date($item->created_at) }}</time>
                                                </div>
                                                <div class="content">{!! $first_record->description !!}</div>
                                                <div class="seemore"> <a
                                                        href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}">
                                                        <span>Xem chi tiết</span><em
                                                            class="material-icons">east</em></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrap-button"> <a class="btn btn-primary" href="">Xem thêm</a></div>
        </div>
    </section>
@elseif(!empty($block_data))
    <section class="section home-4">
        <div class="container">
            <div class="wrap-title">
                <div class="section-title">{{ $block_data['name'] }}
                    <div class="section-title-line"><img class="lazyload"
                            data-src="{{ asset('frontend/assets/img/title.png') }}" alt="Symbol" title="Symbol"
                            width="50" height="50"></div>
                </div>
            </div>
            <div class="wrap-news">
                @if (!empty($news))
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 box-left">
                            @if (!empty($first_record))
                                <div class="news-item lg-item">
                                    <div class="news-item__image"> <a
                                            href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}"><img
                                                src="{{ asset($first_record->image[0] ?? '') }}"
                                                alt="{{ $first_record->link }}"></a></div>
                                    <div class="news-item__detail">
                                        <div class="title"> <a
                                                href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}">{{ $first_record->name }}</a>
                                        </div>
                                        <div class="date">{{ convert_date($first_record->created_at) }}
                                        </div>
                                        <div class="content">{!! $first_record->description !!}
                                        </div>
                                        <div class="seemore"> <a
                                                href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}">
                                                <span>Xem chi tiết</span><em class="material-icons">east</em></a></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 box-right">
                            <div class="row">
                                @if (count($news) > 2 && !empty($news))
                                    @foreach (collect($news)->slice(1) as $item)
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="news-item sm-item">
                                                <div class="news-item__image"> <a
                                                        href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}">
                                                        <img class="lazyload"
                                                            data-src="{{ asset($item->image[0] ?? '') }}" alt=""
                                                            title="" width="285" height="223"></a>
                                                </div>
                                                <div class="news-item__detail">
                                                    <div class="title"> <a
                                                            href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}">{{ @$item->name }}</a>
                                                    </div>
                                                    <div class="date">
                                                        <time>{{ convert_date($item->created_at) }}</time>
                                                    </div>
                                                    <div class="content">{!! $first_record->description !!}</div>
                                                    <div class="seemore"> <a
                                                            href="{{ route('frontend.news.detail', ['url' => $first_record->link]) }}">
                                                            <span>Xem chi tiết</span><em
                                                                class="material-icons">east</em></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="wrap-button"> <a class="btn btn-primary" href="">Xem thêm</a></div>
        </div>
    </section>
@endif
