<div class="pagBlock">
    <div class="pagBox">
        @if ($paginator->onFirstPage())
            <span class="pagIcon hover disabled">
                <svg class="">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#i-pag-prev" />
                </svg></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"> <span class="pagIcon hover">
                    <svg class="">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#i-pag-prev" />
                    </svg></span></a>
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
                    <svg class="">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#i-pag-next" />
                    </svg></span>
            </a>
        @else
            <span class="pagIcon pagNext hover disabled">
                <svg class="">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#i-pag-next" />
                </svg></span>
        @endif

    </div>
    <p class="pagTxt">
        @if ($paginator->lastPage() > 1 && $paginator->currentPage() != 1)
            全{{ $paginator->total() }}件中{{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }}～{{ $paginator->total() <= $paginator->perPage() ? $paginator->total() : ($paginator->currentPage() * $paginator->perPage() >= $paginator->total() ? $paginator->total() : $paginator->currentPage() * $paginator->perPage()) }}件目表示
        @else
            全{{ $paginator->total() }}件中1～{{ $paginator->total() <= $paginator->perPage() ? $paginator->total() : ($paginator->currentPage() * $paginator->perPage() >= $paginator->total() ? $paginator->total() : $paginator->currentPage() * $paginator->perPage()) }}件目表示
        @endif
    </p>
</div>
@else
<div class="pagBlock">
    <p class="pagTxt">
        全{{ $paginator->total() }}件中1～{{ $paginator->total() <= $paginator->perPage() ? $paginator->total() : ($paginator->currentPage() * $paginator->perPage() >= $paginator->total() ? $paginator->total() : $paginator->currentPage() * $paginator->perPage()) }}件目表示
    </p>
</div>
@endif
