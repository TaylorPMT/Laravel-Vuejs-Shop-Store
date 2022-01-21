<div class="pagBlock">
    <div class="pagBox">
        @if ($paginator->onFirstPage())
            <span class="pagIcon pagPrev hover disabled">
            <em class="material-icons">trending_flat</em></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"> <span class="pagIcon pagPrev hover">
            <em class="material-icons">trending_flat</em></span></a>
        @endif
        @if ($paginator->lastPage() <= 4)
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="{{ $url }}">
                                <span class="pagItem active">{{ $page }}</span>
                            </a>

                        @else
                            <a href="{{ $url }}">
                                <span class="pagItem">{{ $page }}</span>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @else
            @if ($paginator->currentPage() > 3)
                <a href="{{ $paginator->url(1) }}"> <span class="pagItem">1</span></a>
            @endif
            @if ($paginator->currentPage() >= 3 && $paginator->currentPage() <= $paginator->lastPage())
                <span class="pagItem2">...</span>
            @endif
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="{{ $url }}">
                                <span class="pagItem active">{{ $page }}</span>
                            </a>
                        @elseif($paginator->currentPage() == 1 && ($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2))
                            <a href="{{ $url }}">
                                <span class="pagItem">{{ $page }}</span>
                            </a>
                        @elseif ($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() - 1 || $page == $paginator->lastPage())
                            <a href="{{ $url }}">
                                <span class="pagItem">{{ $page }}</span>
                            </a>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <span class="pagItem2">...</span>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endif
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">
                <span class="pagIcon pagNext hover">
                <em class="material-icons">trending_flat</em></span>
            </a>
        @else
            <span class="pagIcon pagNext hover disabled">
            <em class="material-icons">trending_flat</em></span>
        @endif

    </div>
    <p class="pagTxt">
        @if ($paginator->lastPage() > 1 && $paginator->currentPage() != 1)
            Tổng
            {{ $paginator->total() }} Từ {{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }}～{{ $paginator->total() <= $paginator->perPage() ? $paginator->total() : ($paginator->currentPage() * $paginator->perPage() >= $paginator->total() ? $paginator->total() : $paginator->currentPage() * $paginator->perPage()) }}

        @else
            Tổng {{ $paginator->total() }} Đang xem
            1～{{ $paginator->total() <= $paginator->perPage() ? $paginator->total() : ($paginator->currentPage() * $paginator->perPage() >= $paginator->total() ? $paginator->total() : $paginator->currentPage() * $paginator->perPage()) }}

        @endif
    </p>
</div>
