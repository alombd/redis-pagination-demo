@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1"><img src="{{ asset('icon/arrow-left.svg') }}"></a>
            </li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><img src="{{ asset('icon/arrow-left.svg') }}"></a></li>
        @endif
        @foreach ($paginator as $element)
            @if (is_string($element))
                <li class="page-item disabled">{{ $element }}</li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        <div class="total-item">
          
            <b>{{$paginator->perPage()}} - {{$paginator->currentPage()}} </b> of <b>{{$paginator->total()}}</b>
        </div>
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><img src="{{ asset('icon/arrow-right.svg') }}"></a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" href="#"><img src="{{ asset('icon/arrow-right.svg') }}"></a>
            </li>
        @endif
    </ul>
    @endif
</nav>
