@extends('base')

@section('title', 'Admin - Edit Product')

@section('main')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Edit Product: {{ $product->id }}</h1>
  
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
            {{ session()->get('errors') }}
        </div>
        @endif
    </div>
    <form method="post" action="{{ route('products.update', $product->id) }}">
        @method('PATCH')
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
                    <input type="file" class="form-control-file border {{ $errors->has('product_image') ? 'is-invalid' : '' }}" name="product_image" value="{{ $product->product_image }}" />
                </div>
            </div>
        </div>
        <div class="row">    
            <div class="col">
                <div class="form-group">
                    <label for="product_category_id">Choose Category:</label>
                    <input type="text" class="form-control {{ $errors->has('product_category_id') ? 'is-invalid' : '' }}" name="product_category_id" value="{{ $product->product_category_id }}" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" class="form-control {{ $errors->has('product_name') ? 'is-invalid' : '' }}" name="product_name" value="{{ $product->product_name }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="product_mrp">MRP:</label>
                    <input type="text" class="form-control {{ $errors->has('product_mrp') ? 'is-invalid' : '' }}" name="product_mrp" value="{{ $product->product_mrp }}" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="product_price">Selling Price:</label>
                    <input type="text" class="form-control {{ $errors->has('product_price') ? 'is-invalid' : '' }}" name="product_price" value="{{ $product->product_price }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="product_quantity">Quantity:</label>
                    <input type="text" class="form-control {{ $errors->has('product_quantity') ? 'is-invalid' : '' }}" name="product_quantity" value="{{ $product->product_quantity }}" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="product_quantity_type">Qunatity Type:</label>
                    <input type="text" class="form-control {{ $errors->has('product_quantity_type') ? 'is-invalid' : '' }}" name="product_quantity_type" value="{{ $product->product_quantity_type }}" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="product_description">Product Description (optional):</label>
            <textarea name="product_description" class="form-control {{ $errors->has('product_description') ? 'is-invalid' : '' }}">{{ $contact->product_description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary float-right">Update</button>
    </form>
</div>
</div>
@endsection