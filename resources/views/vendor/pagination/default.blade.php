@if ($paginator->hasPages())
    <div class="ui pagination menu">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="disabled item"><span>&laquo;</span></div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="item">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <div class="disabled item">{{ $element }}</div>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <div class="active item">{{ $page }}</div>
                    @else
                        <a href="{{ $url }}" class="item">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="item">&raquo;</a>
        @else
            <div class="disabled item">&raquo;</div>
        @endif
    </div>
@endif
