@extends('base')

@section('title', 'Admin - Add New Product')

@section('main')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Add New Product</h1>
   
</div>
<div class="card shadow mb-4">
<div class="card-body">
    <div>
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif

        @if(session()->get('errors'))
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br/>
            @endforeach
        </div>
        @endif
    </div>
    <form method="post" action="{{ route('products.store') }}">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="product_status">Product Status: </label></br>
                    <select class="form-control" id="product_status" name="product_status">
                        <option value="1">Enable</option>
                        <option value="0">Disable</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="product_image">Product Image:</label>
                    <input type="file" class="form-control-file border {{ $errors->has('product_image') ? 'is-invalid' : '' }}" name="product_image" value="{{ old('product_image') }}" />
                </div>
            </div>
        </div>
        <div class="row">    
            <div class="col">
                <div class="form-group">
                    <label for="product_category_id">Choose Category:</label>
                    <select class="form-control" id="product_category_id" name="product_category_id">
                        <option value="">No Category</option>
                        <option value="1">Category 1</option>
                        <option value="1">Category 2</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}" name="product_name" value="{{ old('product_name') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="product_mrp">MRP:</label>
                    <input type="text" class="form-control {{ $errors->has('product_mrp') ? 'is-invalid' : '' }}" name="product_mrp" value="{{ old('product_mrp') }}" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="product_price">Selling Price:</label>
                    <input type="text" class="form-control {{ $errors->has('product_price') ? 'is-invalid' : '' }}" name="product_price" value="{{ old('product_price') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="product_quantity">Quantity:</label>
                    <input type="text" class="form-control {{ $errors->has('product_quantity') ? 'is-invalid' : '' }}" name="product_quantity" value="{{ old('product_quantity') }}" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="product_quantity_type">Qunatity Type:</label>
                    <input type="text" class="form-control {{ $errors->has('product_quantity_type') ? 'is-invalid' : '' }}" name="product_quantity_type" value="{{ old('product_quantity_type') }}" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="product_description">Product Details (optional):</label>
            <textarea name="product_description" class="form-control {{ $errors->has('product_description') ? 'is-invalid' : '' }}">{{ old('product_description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary float-right">Add Product</button>
    </form>
</div>
</div>
@endsection