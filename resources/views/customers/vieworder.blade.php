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
                     <h5 class="py-3">Order Details</h5>
                     <div class="text-muted py-2">
                        <p>Order Id: #{{ $order->id }} </p>
                        <p>Order Date: {{ $order->created_at }}</p>
                     </div>
                  </div>
                  <div>
                  <?php
                  switch($order->status)
                  {
                  case 'pending': $color = 'text-warning'; break; 
                  case 'accepted': $color = 'text-primary'; break;
                  case 'shipped': $color = 'text-info'; break;
                  case 'delivered': $color = 'text-success'; break;
                  case 'declined': $color = 'text-danger'; break;
                  case 'cancelled': $color = 'text-danger'; break;
                  }
                  ?>
                     <p class="py-3 h6">
                        <i class="fa fas fa-circle pr-1 {{ $color }} smallest-text"></i> {{ ucfirst($order->status) }}
                     </p>
                  </div>
               </div>
            </div>
            <hr>
            <div class="album py-3 bg-light">
               <div class="d-flex justify-content-between">
                  <div>
                     <div class="text-muted">
                        <p>1 &nbsp;&nbsp;&nbsp; Order Accepted <p>
                        <p>2 &nbsp;&nbsp;&nbsp; Shipped </p>
                        <p>3 &nbsp;&nbsp;&nbsp; Delivered </p>
                     </div>
                  </div>
                  <div>
                     <div class="text-muted">
                        <p><i class="fa fas fa-check pr-1 smallest-text"></i></p>
                        <p><i class="fa fas fa-check pr-1 smallest-text"></i></p>
                        <p><i class="fa fas fa-check pr-1 smallest-text"></i></p>
                     </div>
                  </div>
               </div>
            </div>
            <hr>
            <div class="album py-3 bg-light">
               <h5 class="py-2 text-muted">Order Items ({{ $order->items_count }})</h5>
               @foreach($orderitems as $product)
               <div class="d-flex justify-content-between">
                  <div>
                     <div class="thumbnail-container thumbnail-padding">
                        <img src="{{ '/demo_images/def.jpg' }}" width="48" height="48">
                     </div>
                     <div class="text-muted">
                        <p>Name: {{ $product->product_name }}<p>
                        <p>Qty: {{ $product->product_qty }}<p>
                        <p>Price: &#8377; {{ $product->product_price }}<p>
                     </div>
                  </div>
                  <div>
                     <div class="text-muted">
                        <p></p>
                        <p></p>
                        <p>&#8377; {{ $product->product_qty * $product->product_price }}</p>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
            <div class="album bg-light">
               <div class="jumbotron padding40">
                  <div class="d-flex justify-content-between">
                     <div>
                        <h5 class="">Item Total</h5>
                        <h5 class="">Delivery</h5>
                        <p class="text-muted">&nbsp;</p>
                        <h5 class="py-3">Grand Total:</h5>                   
                     </div>
                     <div>
                        <p class="h6">&#8377; {{ $order->subtotal }}</p>
                        <p class="h6">&#8377; {{ $order->delivery_charge }}</p>
                        <p class="text-muted">&nbsp;</p>
                        <p class="py-3">&#8377; {{ $order->grand_total }}</p>
                     </div>
                  </div>
               </div>
            </div>
            <hr>
            <div class="album bg-light">
               <h5 class="py-2 text-muted">Customer's Details</h5>
               <div class="row">
               <div class="col-md-4">
                  <div class="d-flex justify-content-between">
                        <div>
                           <p class="">Name</p>
                           <p class="">Phone Number</p>
                           <p class="">Address</p>
                           <p class="">Pincode</p>
                           <p class="">City</p>
                           <p class="">Payment</p>                  
                        </div>
                        <div>
                           <p class="text-muted">{{ $order->customer_name }}</p>
                           <p class="text-muted">{{ $order->customer_phone }}</p>
                           <p class="text-muted">{{ $order->customer_address }}</p>
                           <p class="text-muted">{{ $order->customer_pincode }}</p>
                           <p class="text-muted">{{ $order->customer_city }}</p>
                           <p class="text-muted">{{ strtoupper($order->payment_method) }}</p>
                        </div>
                  </div>
               </div>
               </div>   


            </div>
         </div>
      </div>
   </div>
</div>

<br><br><br>
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