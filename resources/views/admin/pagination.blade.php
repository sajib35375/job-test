





<nav>
    <ul class="pagination d-flex justify-content-center flex-wrap pagination-flat pagination-success">

        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" data-abc="true"><i class="fa-solid fa-chevron-left"></i></a></li>

        @foreach($elements as $element)
            @foreach($element as $page => $url)
                @if($paginator->currentPage()==$page)
                    <li class="page-item active"><a class="page-link" href="{{ $url }}" data-abc="true">{{ $page }}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}" data-abc="true">{{ $page }}</a></li>
                @endif

            @endforeach
        @endforeach




        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" data-abc="true"><i class="fa-solid fa-chevron-right"></i></a></li>

    </ul>
</nav>
