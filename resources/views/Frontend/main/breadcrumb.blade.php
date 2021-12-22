<div class="breadcrumb-wrapper">
    <div class="container">
        <ol class="breadcrumb">
            <ul class="breadcrumb {{ @$breadcrumb['class'] }}">
                @if (!empty(@$breadcrumb) && is_array(@$breadcrumb))
                    @foreach (@$breadcrumb as $item)
                        @if (@$item && !@$item['class'])
                            <li>
                                @if (!empty(@$item['url']))
                                    <a href="{{ @$item['url'] }}"
                                        class="active">{{ rtrim(@$item['name']) }}</a>
                                @else
                                    <span>{{ strip_tags(@$item['name']) }}</span>
                                @endif

                            </li>
                        @endif
                    @endforeach
                @else
                    <li><a href="/">Trang chủ</a></li>
                @endif
            </ul>
        </ol>
    </div>
</div>
