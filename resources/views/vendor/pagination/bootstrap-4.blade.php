@if ($paginator->hasPages())
<div class="pagination-items">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-9">
            <ul class="nav-links">

                @if ($paginator->onFirstPage())
                @else
                <li class="back-next">
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                    </a>
                </li>
                @endif

                @foreach ($elements as $element)

                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))

                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">{{ $element }}</span>
                    </li>

                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))

                        @foreach ($element as $page => $url)

                            @if ($page == $paginator->currentPage())

                            <li class="active" aria-current="page">
                                <a href="javascript:;">{{ $page }}</a>
                            </li>

                            @else

                            <li class="none">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>

                            @endif

                        @endforeach

                    @endif

                @endforeach

                @if ($paginator->hasMorePages())
                  <li class="back-next">
                      <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                          <i class="fa fa-angle-right" aria-hidden="true"></i>
                      </a>
                  </li>
                @else

                @endif
            </ul>
        </div>
    </div>
</div>

@endif
