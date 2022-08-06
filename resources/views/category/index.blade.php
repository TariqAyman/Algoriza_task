@extends('layouts.app')

@section('page-title', 'List Category')
@section('page-heading', 'List Category')

@section('content')
    <div class=" container">
        <table id="categories" class="table table-striped table-bordered nowrap" style="width:100%">
            <caption>List of categories</caption>
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Is Active</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <a href="{{ route('product.create') }}" type="button" class="btn btn-primary">Create New Product</a>
            <a href="{{ route('category.create') }}" class="btn  btn-primary float-right">Add New Category </a>
            <br><br>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>
                        {{ $category->is_active ? 'Active' : 'InActive' }}
                    </td>
                    <td>
                        <a href="{{ route('category.edit',$category->id) }}" class="btn  btn-info">Edit </a>
                        <form action="{{ route('category.destroy',$category->id) }}" method="Post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    @parent
    <script>
        $(document).ready(function () {
            var table = $('#categories').DataTable({
                responsive: true
            });

            new $.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection
