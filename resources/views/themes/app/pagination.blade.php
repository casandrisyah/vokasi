<ul class="pagination pagination-circle pagination-outline">
    @if ($paginator->onFirstPage())
    <li class="page-item previous disabled m-1"><a href="#" class="page-link default"><i class="previous"></i></a></li>
    @else
    <li class="page-item previous m-1"><a href="javascript:;" data-halaman="{{ $paginator->previousPageUrl() }}" class="page-link default"><i class="previous"></i></a></li>
    @endif
    @foreach ($elements as $element)
        @if (is_string($element))
        <li class="page-item disabled m-1"><a href="#" class="page-link default">...</a></li>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li class="page-item active m-1"><a href="javascript:;" data-halaman="{{ $url }}" class="page-link default">{{ $page }}</a></li>
                @else
                <li class="page-item m-1"><a href="{{ $url }}" data-halaman="{{ $url }}" class="page-link default">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
    <li class="page-item next m-1"><a href="javascript:;" data-halaman="{{ $paginator->nextPageUrl() }}" class="page-link default"><i class="next"></i></a></li>
    @else
    <li class="page-item next disabled m-1"><a href="#"  class="page-link default"><i class="next"></i></a></li>
    @endif
</ul>