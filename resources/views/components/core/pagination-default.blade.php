<style>
.pagination-wrapper {
    display: flex !important;
    justify-content: center !important;
}

.default-pagination {
    display: flex !important;
    justify-content: center !important;
    padding-left: 0;
    list-style: none;
    margin: 0;
}

.default-pagination li a {
    display: block;
    padding: 8px 12px;
    text-decoration: none;
    border: 1px solid gray;
    color: black;
    margin: 0 4px;
    border-radius: 5px;
}

.default-pagination li a.active {
    background-color: #4CAF50;
    color: white;
}

.default-pagination li a.disabled {
    color: #dddddd;
    cursor: not-allowed;
    pointer-events: none;
}
</style>


@if ($paginator->hasPages())
<div style="display:flex; justify-content:center; width:100%;">
    <nav class="pagination-wrapper">
        <ul class="default-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">&lsaquo;</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a></li>
            @else
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">&rsaquo;</span></li>
            @endif
        </ul>
    </nav>
    </div>
@endif
