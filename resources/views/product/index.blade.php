@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <main class="col-md-9">
                <header class="border-bottom mb-4 pb-3">
                    <div class="form-inline">
                        <span class="mr-md-auto">
                            {{ $products->count() }} Products found
                        </span>
                        <a href="{{ route('product.create')  }}" type="button" class="btn btn-primary">Create New Product</a>
                    </div>
                </header>
                <div class="row">
                    @if($products->count() > 0)
                        @foreach($products as $product)
                            <div class="col-md-4">
                                <figure class="card card-product-grid">
                                    <div class="img-wrap">
                                        <img src="{{ url($product->image) }}" class="img-fluid">
                                        <a class="btn-overlay" href="{{ route('product.show', $product->id) }}"><i class="fa fa-search-plus"></i> Quick view</a>
                                    </div>
                                    <figcaption class="info-wrap">
                                        <div class="fix-height text-center">
                                            <span href="{{ route('product.show', $product->id) }}" class="title">{{ $product->name }}</span>
                                        </div>
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-block btn-primary">Edit </a>

                                        <form action="{{ route('product.destroy',$product->id) }}" method="Post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-block btn-danger mt-1">Delete</button>
                                        </form>
                                    </figcaption>
                                </figure>
                            </div>
                        @endforeach
                    @else
                        <h3> No Products Found </h3>
                    @endif
                </div>

            </main>
            @include('product.filter')
        </div>

        <div class="d-flex justify-content-center mt-4">
            {!! $products->links() !!}
        </div>
    </div>
@endsection
