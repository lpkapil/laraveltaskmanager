@extends('layouts.customer')
@section('title',  ucfirst($store->store_name).' Store')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12 mt-5">         
            @empty($cartitemcount)
            <div class="row">
               <div class="container-fluid">
                  <div class="justify-content-center" style="min-height: 430px;">
                     <p class="text-center py-3 text-muted"> <i class="fa fas fa-shopping-bag fa-4x"></i></p>
                     <p class="text-center h5">Your bag is empty.</p>
                     <p class="text-center text-muted">You don't have any products in your bag.</p>
                     <p class="text-center"><a class="btn btn-md btn-primary" href="{{ url('/'.$store->store_name) }}">Back to shopping</a></p>
                  </div>
               </div>
            </div>   
            @else
            <div class="row">
               <div class="col-md-12">
                  <p class="h5">Bag ({{ $cartitemcount }})</p>
               </div>
            </div>
            <div class="row py-3">   
               <div class="col-md-8">

                   <?php //echo "<pre>"; print_r($cart); echo "</pre>"; ?>

                   @foreach($cart as $productId => $product)  
                   <div class="row">
                     <div class="col-md-3">
                        <div class="thumbnail-container thumbnail-padding">
                           @empty($product['photo'])
                              <img src="{{ '/demo_images/def.jpg' }}" width="48" height="48">
                           @else
                              <img src="{{ '/storage/product_images/'.$product['photo'] }}" width="48" height="48">
                           @endempty
                        </div>
                     </div>
                     <div class="col-md-9">
                        <div class="float-left">
                           <div class="mb-0">{{ $product['name'] }}</div>
                           <div class="mb-0">&#8377; {{ $product['price'] }} <small class="text-muted">{{ $product['qty'] }} {{ $product['qty_type'] }}</small></div>
                        </div>
                        <div class="input-group col-md-4 float-right">
                           <span class="input-group-btn">
                              <button type="button" class="quantity-left-minus btn btn-default btn-number"  data-type="minus" data-field="" data-url="{{ url('/'.$store->store_name.'/?page=cart&action=remove&product='.$productId) }}">
                                 <i class="fa fas fa-minus"></i>
                              </button>
                           </span>
                           <input type="text" name="quantity" class="quantity form-control input-number" value="{{ $product['quantity'] }}" min="1" max="100">
                           <span class="input-group-btn">
                              <button type="button" class="quantity-right-plus btn btn-default btn-number" data-type="plus" data-field="" data-url="{{ url('/'.$store->store_name.'/?page=cart&action=add&product='.$productId) }}">
                                 <i class="fa fas fa-plus"></i>
                              </button>
                           </span>
                     </div>
                     </div>
                   </div>
                   <hr>
                  @endforeach
                  <a class="btn btn-primary float-right" href="{{ url('/'.$store->store_name.'/?action=emptycart') }}">Empty cart</a>
                  <br><br><br><br>
               </div>
               <div class="col-md-4">
                  <div class="jumbotron">
                     <div class="d-flex justify-content-between">
                        <div>
                           <h5 class="">Item total</h5>
                           <h5 class="">Delivery</h5>
                           <p class="text-muted">Free Delivery above &#8377; {{ $nodevliverycharge }}</p>
                           <h5 class="py-3">Grand total:</h5>
                        </div>
                        <div>
                           <p class="h6">&#8377; {{ $itemstotal }}</p>
                           <p class="h6">&#8377; {{ $deliverycharge }}</p>
                           <p class="text-muted">&nbsp;</p>
                           <p class="py-3">&#8377; {{ $grandtotal }}</p>
                        </div>
                     </div>
                  </div>
                  <a class="btn btn-primary btn-block" href="{{ url('/'.$store->store_name.'/?page=checkout') }}">Select Address</a>
               </div>
            </div>   
            @endempty
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
            <p class="navbar-label mb-10 small">Bag ({{ $cartitemcount }})</p>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
   var quantitiy=0;
   jQuery('.quantity-right-plus').click(function(e){
        e.preventDefault();
        var quantity = parseInt(jQuery(this).parent().parent().find("input").val());
        jQuery(this).parent().parent().find("input").val(quantity + 1);
        window.location.href = jQuery(this).attr('data-url');
    });

    jQuery('.quantity-left-minus').click(function(e){
        e.preventDefault();
        var quantity = parseInt(jQuery(this).parent().parent().find("input").val());
        if(quantity>0){
         jQuery(this).parent().parent().find("input").val(quantity - 1);
         window.location.href = jQuery(this).attr('data-url');
        }
    });
});
</script>