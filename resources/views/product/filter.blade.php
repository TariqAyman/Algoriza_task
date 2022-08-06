<aside class="col-md-3">
    <div class="card">
        <article class="filter-group">
            <header class="card-header">
                <h6 class="title">Filter By <a href="{{ route('category.index') }}">Categories </a></h6>
            </header>
            <div class="filter-content collapse show" id="collapse_2" style="">
                <div class="card-body">
                    <ul class="list-menu">
                        @if($categories->count() > 0)
                            @foreach($categories as $key => $category)
                                <li>
                                    <a href="{{ route('product.index', ['category' => $key]) }}">{{ $category }}  </a>
                                </li>
                            @endforeach
                        @else
                            NO CATEGORIES ADDED YET
                        @endif
                    </ul>

                </div>
            </div>
        </article>
    </div>
</aside>
