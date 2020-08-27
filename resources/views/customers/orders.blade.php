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
                        <h5 class="py-3">Orders</h5>
                     </div>
                     <div>
                        <p class="py-3 h6">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                          onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
                                          <i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}
                                       </a>

                                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                       </form>
                        </p>
                     </div>
                  </div>
               </div>
               <div style="min-height: 430px;">
                  <p class="text-center h5 py-5 text-muted">Orders Page</p>
               </div>
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
@endsection