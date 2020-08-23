

@extends('layouts.customer')
@section('title',  ucfirst($store->store_name).' Store')
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="container mt-5">
         <div class="row justify-content-center">
            <div class="container-fluid">
               <div class="input-group mb-3">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1"><i class="fa far fa-search"></i></span>
                        </div>
                        <input class="form-control form-control-lg" type="text" placeholder="Search categories or products" aria-describedby="basic-addon1">
                     </div>
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
                     <div class="col-md-2">
                        <div class="card mb-4 box-shadow">
                           <img class="card-img-top" src="{{ '/demo_images/def.jpg' }}" alt="Card image cap" >
                           <div class="card-body">
                              <p class="card-text"><a href="{{ url('/'.$store->store_name.'/?page=products&cat=1') }}" class="stretched-link">Category 1</a></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="album py-1 bg-light">
                  <div class="d-flex justify-content-between">
                     <div>
                        <h5 class="py-3">Category 1 <small class="text-muted">(5)</small></h5>
                     </div>
                     <div>
                        <p class="py-3 h6"><a href="{{ url('/'.$store->store_name.'/?page=products&cat=1') }}">Sell All</a></p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-3">
                        <div class="card mb-4 box-shadow">
                           <img class="card-img-top" src="{{ '/demo_images/def.jpg' }}" alt="Card image cap" >
                           <div class="card-body">
                              <p class="card-text">Product 1</p>
                              <div class="d-flex justify-content-between align-items-center">
                                 <p  class="text-muted font-weight-bold">&#8377; 10 <small class="text-muted">1 piece</small></p>
                                 <div class="btn-group">
                                    <button type="button" class="btn btn-md btn-primary">Add</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="card mb-4 box-shadow">
                           <img class="card-img-top" src="{{ '/demo_images/def.jpg' }}" alt="Card image cap" >
                           <div class="card-body">
                              <p class="card-text">Product 1</p>
                              <div class="d-flex justify-content-between align-items-center">
                                 <p  class="text-muted font-weight-bold">&#8377; 10</p>
                                 <div class="btn-group">
                                    <button type="button" class="btn btn-md btn-primary">Add</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
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
                    <p class="navbar-label mb-10 small">Bag</p>
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
   </div>
</div>
@endsection

