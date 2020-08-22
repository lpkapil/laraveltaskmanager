<!-- @extends('layouts.admin')

@section('title', 'Admin - Dashboard')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
   <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<div class="row">
   <div class="col-lg-6">
      <div class="card mb-4 py-3 border-left-primary">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Store</div>
                  @empty($store)
                     <a href="{{ url('/stores/create') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Create New Store
                     </a>
                  @else
                     <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <a href="{{ config('app.url').$store }}" target="_blank">
                           <i class="fas fa-fw fa-link fa-xs" aria-hidden="true"></i> {{ config('app.url').$store }}
                        </a>
                     </div>
                  @endempty
               </div>
               <div class="col-auto">
                  <i class="fas fa-store fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-3">
      <div class="card mb-4 py-3 border-left-primary">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Products</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-cubes fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-3">
      <div class="card mb-4 py-3 border-left-primary">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Categories</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-th-large fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
          
@endsection -->
