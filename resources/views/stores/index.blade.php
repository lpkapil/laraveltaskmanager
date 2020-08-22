@extends('base')
@section('title', 'Admin - Stores Listing')
@section('main')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Stores</h1>   
</div>
<div>
   @if(session()->get('success'))
   <div class="alert alert-success">
      {{ session()->get('success') }}
   </div>
   @endif
   @if(session()->get('errors'))
   <div class="alert alert-danger">
      {{ session()->get('errors') }}
   </div>
   @endif
</div>
<?php if(count($stores) == 0 && (!in_array('admin', Auth::user()->roles->pluck('slug')->toArray()))): ?>
<div>
   <a href="{{ route('stores.create')}}" class="btn btn-primary mb-3"><i class="fa fa-plus" aria-hidden="true"></i> Add New Store</a>
</div>
<?php endif; ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Store Logo</th>
                  <th>Store Name</th>
                  <th>Store Description</th>
                  <th>Store Address</th>
                  <th>Created By</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               @foreach($stores as $store)
               <tr>
                  <td>{{$store->id}}</td>
                  <td><img src="{{ '/storage/'.$store->store_logo }}" width="48" height="48"></td>
                  <td>{{$store->store_name}}</td>
                  <td>{{$store->store_description}}</td>
                  <td>{{$store->store_address}}</td>
                  <td>{{$store->user_id}}</td>
                  <?php if(in_array('admin', Auth::user()->roles->pluck('slug')->toArray())): ?>
                  <td>
                     <form action="{{ route('stores.destroy', $store->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                     </form>
                  </td>
                  <?php else: ?>
                     <td>
                        <a href="{{ route('stores.edit',$store->id)}}" class="btn btn-primary">Edit</a>
                     </td>
                  <?php endif;?>
               </tr>
               @endforeach
            </tbody>
         </table>
         {{ $stores->links() }}
      </div>
   </div>
</div>
@endsection