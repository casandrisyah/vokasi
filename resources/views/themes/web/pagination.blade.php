<div class="pagination d-flex justify-content-between">
    {{-- Previous Page Link --}}
    @if (!$paginator->onFirstPage())
        <a class="btn btn-outline-secondary me-auto" href="{{ $paginator->previousPageUrl() }}" rel="prev">&larr; Sebelumnya</a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a class="btn btn-outline-secondary ms-auto" href="{{ $paginator->nextPageUrl() }}" rel="next">Selanjutnya &rarr;</a></li>
    @endif
</div>
