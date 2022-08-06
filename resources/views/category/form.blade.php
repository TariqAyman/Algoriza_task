@extends('layouts.app')

@if($edit)
    @section('page-title', 'Edit Category')
    @section('page-heading', 'Edit Category')
@else
    @section('page-title', 'Create Category')
    @section('page-heading','Create Category')
@endif

@section('content')
    @if($edit)
        {!! Form::open(['route' => ['category.update',$category->id], 'method' => 'PUT','files' => false, 'id' => 'edit-form','class' => 'container']) !!}
    @else
        {!! Form::open(['route' => 'category.store', 'files' => false, 'id' => 'create-form' , 'class' => 'container']) !!}
    @endif
    <div class="form-group">
        <label for="name">Category Name</label>
        {{ Form::text('name', $edit ? $category->name : old('name'), ['class' => 'form-control','required' , 'placeholder' => 'Enter name']) }}
    </div>

    <div class="form-group">
        <label for="is_active">Choose Activity Status</label>
        <select class="form-control" name="is_active" id="is_active" required>
            <option>choose Category Activity</option>
            <option value="1" @if($edit && $category->is_active == 1 || old('is_active') == 1) selected @endif >Active</option>
            <option value="0" @if($edit && $category->is_active == 0 || old('is_active') == 0) selected @endif >InActive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    {{ Form::close() }}
@endsection

@section('js')
    @parent

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script>
        $(function () {
            $('input')
                .on('change', function (event) {
                    var $element = $(event.target);

                    var $container = $element.closest('.example');

                    if (!$element.data('tagsinput')) return;

                    var val = $element.val();

                    if (val === null) val = 'null';

                    var items = $element.tagsinput('items');

                    $('code', $('pre.val', $container)).html(
                        $.isArray(val)
                            ? JSON.stringify(val)
                            : '"' + val.replace('"', '\\"') + '"'
                    );

                    $('code', $('pre.items', $container)).html(
                        JSON.stringify($element.tagsinput('items'))
                    );
                })
                .trigger('change');
        });
    </script>
@endsection
