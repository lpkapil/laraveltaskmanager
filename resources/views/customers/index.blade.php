@extends('layouts.customer')

@section('title',  ucfirst($store->store_name).' Store')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="content">
                    <div class="jumbotron">
                        <div class="container">
                            <h4 class="display-5">About {{ $store->store_name }}</h4>
                            @empty($store->store_description)
                                <p>This is demo text about the store created using store manager, You can change store information like logo, 
                                description and store address from the admin store edit page to replace this text.</p>
                            @else
                                <p>{{ $store->store_description }}</p>
                            @endempty

                            
                            <br><h5 class="display-5"> Address: </h5>
                            @empty($store->store_description)
                                <p>This is demo address about the store created using store manager, You can change store information from the admin store edit page to replace this text.</p>
                            @else
                                <p>{{ $store->store_address }}</p>
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection