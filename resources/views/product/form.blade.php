@extends('layouts.app')

@if($edit)
    @section('page-title', 'Edit Product')
    @section('page-heading', 'Edit Product')
@else
    @section('page-title', 'Create Product')
    @section('page-heading','Create Product')
@endif

@section('content')
    @if($categories->count()> 0)
        @if($edit)
            {!! Form::open(['route' => ['product.update',$product->id], 'method' => 'PUT','files' => true, 'id' => 'edit-form','class' => 'container']) !!}
        @else
            {!! Form::open(['route' => 'product.store', 'files' => true, 'id' => 'create-form' , 'class' => 'container']) !!}
        @endif

        <div class="form-group">
            <label for="name">Product Name</label>
            {{ Form::text('name', $edit ? $product->name : old('name'), ['class' => 'form-control','required' , 'placeholder' => 'Enter name']) }}
        </div>

        <div class="form-group">
            <label for="description">Product Description</label>
            {{ Form::textarea('description', $edit ? $product->description : old('description'), ['class' => 'form-control','required' , 'placeholder' => 'Enter description']) }}
        </div>

        <div class=" form-group ">
            <label for="tags">Product Tags : </label>
            {{ Form::text('tags', $edit ? $product->tags : old('tags'), ['class' => 'form-control','required' , 'placeholder' => 'Enter tags']) }}
            <span class="text text-danger">Hit enter or comma button for the new word(tag)</span>
        </div>

        <div class="form-group">
            <label for="category_id">Select Category</label>
            {{ Form::select('category_id', $categories, $edit ? $product->category_id : null, [ 'class'=> 'selectpicker form-control', 'placeholder' => 'Select...', 'required']) }}
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" class="form-control-file" name="image" id="image" {{ $edit ? '' : 'required' }}>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        {!! Form::close() !!}
    @else
        <div class="container">
            <h3 class=" text-danger">You Can't Add New Product , No Categories Active Yet</h3>
            <h2>
                Add Category <a href="{{ route('product.create') }}" class="btn  btn-primary ">Add New Category </a>
            </h2>
        </div>
    @endif
@endsection
