@extends('layouts.customer')
@section('title',  ucfirst($store->store_name).' Store')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12 mt-5">
         <div class="row justify-content-center">
            <div class="container-fluid">
               <div class="album py-1 bg-light">
                  <div class="d-flex justify-content-between">
                     <div>
                        <h5 class="">Checkout</h5>
                        <p class="text-muted">Payment of &#8377; {{ $grandtotal }}</p>
                     </div>
                     <div>
                        <p class="py-3 h6"></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-8 mt-2">

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
    
         <form method="post" action="{{ route('placeorder') }}">
            @csrf
            <div class="row">
               <div class="col">
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" aria-describedby="name" placeholder="Name">
                  </div>
               </div>
               <div class="col">
                  <div class="form-group">
                     <label for="phone">Phone No</label>
                     <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" name="phone" aria-describedby="phone" placeholder="Phone Number">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col">
                  <div class="form-group">
                     <label for="city">City</label>
                     <input type="text" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" id="city" name="city" aria-describedby="city" placeholder="City">
                  </div>
               </div>
               <div class="col">
                  <div class="form-group">
                     <label for="pincode">Pincode</label>
                     <input type="text" class="form-control {{ $errors->has('pincode') ? 'is-invalid' : '' }}" id="pincode" name="pincode" aria-describedby="pincode" placeholder="pincode">
                  </div>
               </div>
            </div>
            <div class="form-group">
                     <label for="address">Address</label>
                     <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address" placeholder="Address"></textarea>
                  </div>       
      </div>
      <div class="col-md-4">
         <h6 class="py-3 text-muted">PAYMENT METHOD</h6>
            <div class="form-group">
               <label class="radio-inline form-control {{ $errors->has('payment') ? 'is-invalid' : '' }}">
               <input type="radio" name="payment" value="cod" checked> Cash/UPI on Delivery
               </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Place Order</button>
         </form>
      </div>
   </div>
   <br><br><br><br>  
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