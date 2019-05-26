@if ($paginator->hasPages())
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="pagination-previous" disabled><font-awesome-icon icon="arrow-left" />@lang('pagination.previous')</a>
        @else
            <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev"><font-awesome-icon icon="arrow-left" />@lang('pagination.previous')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')<font-awesome-icon icon="arrow-right" /></a>
        @else
            <a class="pagination-next" disabled>@lang('pagination.next')<font-awesome-icon icon="arrow-right" /></a>
        @endif
    </nav>
@endif
