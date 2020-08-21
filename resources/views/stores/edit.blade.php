@extends('base')

@section('title', 'Admin - Edit Store')

@section('main')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Edit Store: {{ $store->id }}</h1>
  
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
    <form method="post" action="{{ route('stores.update', $store->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="row">    
            <div class="col">
                <div class="form-group">
                    <label for="store_logo">Store Logo:</label>
                    <input type="file" class="form-control-file border {{ $errors->has('store_logo') ? 'is-invalid' : '' }}" name="store_logo" value="{{ $store->store_logo }}" />
                    @error('store_logo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col ">
                <div class="form-group text-center">
                    <img src="{{ '/storage/'.$store->store_logo }}" width="100" height="100">
                </div>
            </div>
        </div>    
       
        <div class="form-group">
            <label for="store_name">Store Name:</label>
            <input type="text" class="form-control {{ $errors->has('store_name') ? 'is-invalid' : '' }}" name="store_name" value="{{ $store->store_name }}" />
        </div>
        <div class="form-group">
            <label for="store_description">Store Description:</label>
            <textarea name="store_description" class="form-control {{ $errors->has('store_description') ? 'is-invalid' : '' }}">{{ $store->store_description }}</textarea>
        </div>
        <div class="form-group">
            <label for="store_address">Store Address:</label>
            <textarea name="store_address" class="form-control {{ $errors->has('store_address') ? 'is-invalid' : '' }}">{{ $store->store_address }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary float-right">Update</button>
    </form>
</div>
</div>
@endsection