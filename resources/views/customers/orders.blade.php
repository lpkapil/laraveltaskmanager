@extends('layouts.customer')
@section('title',  ucfirst($store->store_name).' Store')
@section('content')
<div class="container">
<div class="row">
   <div class="col-md-12 mt-5">

      @empty($totalorders)
            <div class="row">
               <div class="container-fluid">
                  <div class="justify-content-center min_height">
                     <p class="text-center py-3 text-muted"> <i class="fa fas fa-list-ul fa-4x"></i></p>
                     <p class="text-center text-muted">You don't have any orders.</p>
                     <p class="text-center"><a class="btn btn-md btn-primary" href="{{ url('/'.$store->store_name) }}">Back to shopping</a></p>
                  </div>
               </div>
            </div>   
         @else
            <div class="row">
               <div class="col-md-12">
                  <p class="h5">Orders ({{ $totalorders }})</p>
               </div>
            </div>
            @endempty

   </div>
</div>
<div class="row">
   <div class="col-md-12 mt2">
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
   </div>
</div>
@foreach($orders as $order)
<div class="d-flex justify-content-between py-2">
   <div>
      <!-- <div class="thumbnail-container thumbnail-padding">
         <img src="{{ '/demo_images/def.jpg' }}" width="48" height="48">
      </div> -->
      <p class="mb-0">Order ID: #{{ $order->id }}</p>
      <p class="mb-0 text-muted">No of Items: {{ $order->items_count }}</p>

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

      <p class="mb-0 text-muted">Order Status: <i class="fa fas fa-circle pr-1 {{ $color }} smallest-text"></i> {{ ucfirst($order->status) }}</p>
      <p class="mb-0 text-muted">Order Total: &#8377; {{ $order->grand_total }}</p>
      <p class="mb-0 text-muted">Order Date: {{ $order->created_at }}</p>
   </div>
   <div>
      <a class="btn btn-md btn-primary" href="{{ url('/'.$store->store_name.'/?action=vieworder&page=orders&id='.$order->id) }}">View Order</a>
   </div>
</div>
<hr>
@endforeach

{{ $orders->appends(request()->except('p'))->links() }}

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