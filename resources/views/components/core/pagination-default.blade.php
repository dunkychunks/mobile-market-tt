@if ($paginator->hasPages())
<div class="d-flex justify-content-center mt-2">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm flex-wrap justify-content-center gap-1" style="--bs-pagination-active-bg: var(--bs-success, #2e7d32);">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link rounded-pill px-3">&lsaquo;</span></li>
            @else
                <li class="page-item"><a class="page-link rounded-pill px-3" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a></li>
            @endif

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link rounded-pill px-3" style="background-color:#28a745;border-color:#28a745;">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item"><a class="page-link rounded-pill px-3" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link rounded-pill px-3" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link rounded-pill px-3">&rsaquo;</span></li>
            @endif

        </ul>
    </nav>
</div>
@endif
