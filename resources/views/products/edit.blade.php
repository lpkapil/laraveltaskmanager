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
    <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="product_status">Product Status: </label></br>
                    <select class="form-control {{ $errors->has('product_status') ? 'is-invalid' : '' }}" id="product_status" name="product_status" value="{{ $product->product_status }}">
                        <option value="1" {{ $product->product_status == '1' ? 'selected' : '' }}>Enable</option>
                        <option value="0" {{ $product->product_status == '0' ? 'selected' : '' }}>Disable</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="product_image">Product Image:</label>
                            <input type="file" class="form-control-file border {{ $errors->has('product_image') ? 'is-invalid' : '' }}" name="product_image" value="{{ $product->product_image }}" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group text-center">
                            @empty($product->product_image)
                                <img src="{{ '/demo_images/def.jpg' }}" width="100" height="100">
                            @else
                            <img src="{{ '/storage/product_images/'.$product->product_image }}" width="100" height="100">
                            @endempty
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">    
            <div class="col">
                <div class="form-group">
                    <label for="product_category_id">Choose Category:</label>
                    <select class="form-control {{ $errors->has('product_category_id') ? 'is-invalid' : '' }}" id="product_category_id" name="product_category_id" value="{{ $product->product_category_id }}">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ $product->product_category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                    </select>
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
                    <input type="number" class="form-control {{ $errors->has('product_mrp') ? 'is-invalid' : '' }}" name="product_mrp" value="{{ $product->product_mrp }}" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="product_price">Selling Price:</label>
                    <input type="number" class="form-control {{ $errors->has('product_price') ? 'is-invalid' : '' }}" name="product_price" value="{{ $product->product_price }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="product_quantity">Quantity:</label>
                    <input type="number" class="form-control {{ $errors->has('product_quantity') ? 'is-invalid' : '' }}" name="product_quantity" value="{{ $product->product_quantity }}" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="product_quantity_type">Qunatity Type:</label>
                    <select class="form-control {{ $errors->has('product_quantity_type') ? 'is-invalid' : '' }}" id="product_quantity_type" name="product_quantity_type" value="{{ $product->product_quantity_type }}">
                        <option value="piece" {{ $product->product_quantity_type == 'piece' ? 'selected' : '' }}>piece</option>
                        <option value="kg" {{ $product->product_quantity_type == 'kg' ? 'selected' : '' }}>kg</option>
                        <option value="gm" {{ $product->product_quantity_type == 'gm' ? 'selected' : '' }}>gm</option>
                        <option value="litre" {{ $product->product_quantity_type == 'litre' ? 'selected' : '' }}>litre</option>
                        <option value="ml" {{ $product->product_quantity_type == 'ml' ? 'selected' : '' }}>ml</option>
                        <option value="dozen" {{ $product->product_quantity_type == 'dozen' ? 'selected' : '' }}>dozen</option>
                        <option value="ft" {{ $product->product_quantity_type == 'ft' ? 'selected' : '' }}>ft</option>
                        <option value="meter" {{ $product->product_quantity_type == 'meter' ? 'selected' : '' }}>meter</option>
                        <option value="sq.ft." {{ $product->product_quantity_type == 'sq.ft.' ? 'selected' : '' }}>sq.ft.</option>
                        <option value="sq.meter" {{ $product->product_quantity_type == 'sq.ft.' ? 'selected' : '' }}>sq.meter</option>
                        <option value="set" {{ $product->product_quantity_type == 'set' ? 'selected' : '' }}>set</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="product_description">Product Description (optional):</label>
            <textarea name="product_description" class="form-control {{ $errors->has('product_description') ? 'is-invalid' : '' }}">{{ $product->product_description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary float-right">Update</button>
    </form>
</div>
</div>
@endsection