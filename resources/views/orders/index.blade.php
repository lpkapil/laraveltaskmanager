@extends('base')
@section('title', 'Admin - Orders Listing')
@section('main')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Orders</h1>
   <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export Contacts</a>
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
<!-- DataTales Example -->
<div class="card shadow mb-4">
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Items</th>
                  <th>Amount</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Created By</th>
                  <?php if((in_array('admin', Auth::user()->roles->pluck('slug')->toArray()))): ?>
                     <th>Store</th>
                  <?php else: ?>
                     <th colspan = 2>Actions</th>
                  <?php endif; ?>
                  
               </tr>
            </thead>
            <tbody>
               @foreach($orders as $order)
               <tr>
                  <td>{{$order->id}}</td>
                  <td>{{$order->items_count}}</td>
                  <td>{{$order->grand_total}}</td>
                  <td>{{$order->customer_name}}</td>
                  <td>{{$order->customer_phone}}</td>
                  <td>{{$order->customer_address}}</td>
                  <td>{{$order->status}}</td>
                  <td>{{$order->user_id}}</td>
                  <?php if((in_array('admin', Auth::user()->roles->pluck('slug')->toArray()))): ?>
                     <td>{{$order->store_id}}</td>
                  <?php else: ?>
                     <td>
                        <form action="{{ route('orders.edit', $order->id)}}" method="post">
                           @csrf
                           @method('DELETE')
                           <button class="btn btn-primary" type="submit">Accept</button>
                        </form>
                     </td>
                     <td>
                        <form action="{{ route('orders.edit', $order->id)}}" method="post">
                           @csrf
                           @method('DELETE')
                           <button class="btn btn-danger" type="submit">Decline</button>
                        </form>
                     </td>
                  <?php endif; ?>
                  
               </tr>
               @endforeach
            </tbody>
         </table>
         {{ $orders->links() }}
      </div>
   </div>
</div>
@endsection