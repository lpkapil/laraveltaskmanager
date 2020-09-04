@extends('layouts.customer')
@section('title',  ucfirst($store->store_name).' Store')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12 mt-5">
         <div class="row justify-content-center">
            <div class="container-fluid">
               <form method="post" action="{{ route('search') }}">
                  @csrf
                  <div class="input-group mb-3">
                     <input class="form-control" type="text" name="search" placeholder="Search categories or products" aria-describedby="basic-addon1" value="{{ old('search') }}" />
                     <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary input-group-text" type="submit"><i class="fa far fa-search"></i></button>
                     </div>
                  </div>
               </form>
               <?php $hasProducts = false; ?>
               @foreach($categories as $category)
                  <?php $hasProducts = false; ?>
                  @if($category->products()->where('product_status', '1')->count() > 0)
                     <?php $hasProducts = true; ?>
                  @endif
               @endforeach
               @if(!$hasProducts)
               <div style="min-height: 430px;">
                  <p class="text-center h5 py-5 text-muted">No categories found</p>
               </div>
               @endif
               @if($hasProducts)
               <div class="album py-1 bg-light">
                  <div class="d-flex justify-content-between">
                     <div>
                        <h5 class="py-3">Listed Categories</h5>
                     </div>
                  </div>
                  <div class="row">
                     @foreach($categories as $category)
                     @if($category->products()->where('product_status', '1')->count() > 0)
                     <div class="col-md-3">
                        <div class="card mb-4 box-shadow">
                           <img class="card-img-top" src="{{ '/demo_images/def.jpg' }}" alt="Card image cap" >
                           <div class="card-body">
                              <p class="card-text"><a href="{{ url('/'.$store->store_name.'/?page=products&cat='.$category->id) }}" class="stretched-link text-muted text-decoration-none">{{ $category->name }}</a></p>
                           </div>
                        </div>
                     </div>
                     @endif
                     @endforeach
                  </div>
               </div>
               <br><br><br>
               @endif
            </div>
         </div>
      </div>
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