@extends('layouts.customer')
@section('title',  ucfirst($store->store_name).' Store is offline now')
@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-12 mt-5">
         <div class="row">
               <div class="container-fluid">
                  <div class="justify-content-center min_height">
                     <p class="text-center py-3 text-muted"> <i class="fa fa-fw fa-store fa-4x"></i></p>
                     <p class="text-center h5 text-muted">{{ $store->store_closed_message }}</p>
                  </div>
               </div>
            </div> 
      </div>
   </div>
</div>
<div class="jumbotron" id="aboutstore">
   <div class="container">
      <h6 class="display-5 text-muted">STORE DETAILS</h6>
      <br>
      <h5>{{ ucfirst($store->store_name) }}</h5>
      @empty($store->store_description)
      <p>This is demo address about the store created using store manager, You can change store information from the admin store edit page to replace this text.</p>
      @else
      <p>{{ $store->store_address }}</p>
      @endempty
      <span class="text-muted">{{ ucfirst($store->store_name).' Store' }} &copy; <?php echo date("Y"); ?></span>
   </div>
</div>
@endsection