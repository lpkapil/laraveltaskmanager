@extends('layouts.customer')
@section('title',  ucfirst($store->store_name).' Store')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12 mt-5">
         <div class="row justify-content-center">
            <div class="container-fluid">
               <form method="post" action="{{ route( 'search') }}">
                  @csrf
                  <div class="input-group mb-3">
                     <input class="form-control" type="search" name="search" placeholder="Search categories or products" aria-describedby="basic-addon1" value="{{ old('search') }}" />
                     <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary input-group-text" type="submit"><i class="fa far fa-search"></i></button>
                     </div>
                  </div>
               </form>
               <?php $hasProducts = false; ?>
               @foreach($categories as $category)
                  @if($category->products()->where('product_status', '1')->count() > 0)
                     <?php $hasProducts = true; ?>
                  @endif
               @endforeach
               @if(!$hasProducts)
               <div style="min-height: 430px;">
                  <p class="text-center h5 py-5 text-muted">No products found</p>
               </div>
               @endif
               @if($hasProducts)
               <div class="album py-1 bg-light">
                  <div class="d-flex justify-content-between">
                     <div>
                        <h5 class="py-3">Top Categories</h5>
                     </div>
                     <div>
                        <p class="py-3 h6"><a href="{{ url('/'.$store->store_name.'/?page=categories') }}">Sell All</a></p>
                     </div>
                  </div>
                  <div class="row">
                     @foreach($categories as $category)
                     @if($category->products()->where('product_status', '1')->count() > 0)
                     <div class="col-md-2">
                        <div class="card mb-4 box-shadow">
                           @empty($category->image)
                           <img class="card-img-top" src="{{ '/demo_images/def.jpg' }}" alt="Card image cap" >
                           @else
                              <img class="card-img-top" src="{{ '/storage/category_images/'.$category->image }}" width="100" height="100">
                           @endempty
                           <div class="card-body">
                              <p class="card-text"><a href="{{ url('/'.$store->store_name.'/?page=products&cat='.$category->id) }}" class="stretched-link text-muted text-decoration-none">{{ str_limit($category->name, $limit = 15, $end = '...') }}</a></p>
                           </div>
                        </div>
                     </div>
                     @endif
                     @endforeach
                  </div>
               </div>
               @endif
               @foreach($categories as $category)
               @if($category->products()->where('product_status', '1')->count() > 0)
               <div class="album py-1 bg-light">
                  <div class="d-flex justify-content-between">
                     <div>
                        <h5 class="py-3">{{ ucfirst($category->name) }}<small class="text-muted"> ({{ $category->products->count() }})</small></h5>
                     </div>
                     <div>
                        <p class="py-3 h6"><a href="{{ url('/'.$store->store_name.'/?page=products&cat='.$category->id) }}">Sell All</a></p>
                     </div>
                  </div>
                  <div class="row">
                     @foreach($category->products as $product)
                     @if($product->product_status == '1')
                     <div class="col-md-3">
                        <div class="card mb-4 box-shadow">
                           @empty($product->product_image)
                              <img class="card-img-top" src="{{ '/demo_images/def.jpg' }}" >
                           @else
                              <img class="card-img-top" src="{{ '/storage/product_images/'.$product->product_image }}" width="250" height="250">
                           @endempty
                           <div class="card-body">
                              <p class="card-text">{{ ucfirst($product->product_name) }}</p>
                              <div class="d-flex justify-content-between align-items-center">
                                 <p  class="text-muted font-weight-bold">&#8377; <strike>{{ $product->product_mrp }}</strike> {{ $product->product_price }} <small class="text-muted">{{ $product->product_quantity }} {{ $product->product_quantity_type }}</small></p>
                                 <div class="btn-group">
                                    <a class="btn btn-md btn-primary" href="{{ url('/'.$store->store_name.'/?action=add&product='.$product->id) }}">Add</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endif
                     @endforeach   
                  </div>
               </div>
               @endif
               @endforeach
            </div>
         </div>
      </div>
   </div>
</div>
<div class="jumbotron">
   <div class="container">
      <h6 class="display-5 text-muted">STORE DETAILS</h6>
      <br>
      <h5>{{ ucfirst($store->store_name) }}</h5>
      <!-- @empty($store->store_description)
         <p>This is demo text about the store created using store manager, You can change store information like logo, 
            description and store address from the admin store edit page to replace this text.
         </p>
         @else
         <p>{{ $store->store_description }}</p>
         @endempty -->
      <!-- <h5 class="display-5"> Address: </h5> -->
      @empty($store->store_description)
      <p>This is demo address about the store created using store manager, You can change store information from the admin store edit page to replace this text.</p>
      @else
      <p>{{ $store->store_address }}</p>
      @endempty
      <span class="text-muted">{{ ucfirst($store->store_name).' Store' }} &copy; <?php echo date("Y"); ?></span>
   </div>
</div>
<nav class="fixed-bottom border-top bg-white">
   <div class="row text-center mt-10">
      <div class="col mt-2">
         <a aria-current="page" class="text-muted" id="nav_home" href="{{ url('/'.$store->store_name) }}">
            <i class="fa fas fa-home fa-2x"></i>
            <p class="navbar-label mb-10 small">Home</p>
         </a>
      </div>
      <div class="col mt-2">
         <a aria-current="page" class="text-muted" id="nav_home" href="{{ url('/'.$store->store_name.'/?page=categories') }}">
            <i class="fa fas fa-th-large fa-2x"></i>
            <p class="navbar-label mb-10 small">Categories</p>
         </a>
      </div>
      <div class="col mt-2">
         <a aria-current="page" class="text-muted" id="nav_home" href="{{ url('/'.$store->store_name.'/?page=cart') }}">
            <i class="fa fas fa-shopping-bag fa-2x"></i>
            <p class="navbar-label mb-10"><span class="small">Bag</span> <span class="badge badge-pill badge-primary">{{ $cartitemcount }}</span></p>
         </a>
      </div>
      <div class="col mt-2">
         <a aria-current="page" class="text-muted" id="nav_home" href="{{ url('/'.$store->store_name.'/?page=orders') }}">
            <i class="fa fas fa-list-ul fa-2x"></i>
            <p class="navbar-label mb-10 small">Orders</p>
         </a>
      </div>
   </div>
</nav>
@endsection