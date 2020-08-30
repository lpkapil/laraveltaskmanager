@extends('base')
@section('title', 'Admin - Orders Listing')
@section('main')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Orders</h1>
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
                  <td>&#8377; {{ $order->grand_total }}</td>
                  <td>{{$order->customer_name}}</td>
                  <td>{{$order->customer_phone}}</td>
                  <td>{{$order->customer_address}}</td>
                  <td>{{ ucfirst($order->status) }}</td>
                  <td>{{$order->user_id}}</td>
                  <?php if((in_array('admin', Auth::user()->roles->pluck('slug')->toArray()))): ?>
                     <td>{{$order->store_id}}</td>
                  <?php else: ?>
                     <td>
                        <?php if( $order->status == 'pending'):?>
                           <form action="{{ route('orders.edit', $order->id.'|accepted')}}">
                              @csrf
                              @method('GET')
                              <button class="btn btn-primary" type="submit">Accept</button>
                           </form>
                        <?php endif; ?>
                        <?php if( $order->status == 'accepted'):?>
                           <form action="{{ route('orders.edit', $order->id.'|shipped')}}" method="post">
                              @csrf
                              @method('GET')
                              <button class="btn btn-primary" type="submit">Ship</button>
                           </form>
                        <?php endif; ?>
                        <?php if( $order->status == 'shipped'):?>
                           <form action="{{ route('orders.edit', $order->id.'|delivered')}}" method="post">
                              @csrf
                              @method('GET')
                              <button class="btn btn-primary" type="submit">Deliver</button>
                           </form>
                        <?php endif; ?>
                     </td>
                     <td>
                        <?php if( $order->status == 'pending'):?>
                           <form action="{{ route('orders.edit', $order->id.'|declined')}}" method="post">
                              @csrf
                              @method('GET')
                              <button class="btn btn-danger" type="submit">Decline</button>
                           </form>
                        <?php elseif(in_array($order->status, ['accepted', 'shipped'])): ?>
                        <form action="{{ route('orders.edit', $order->id.'|cancelled')}}" method="post">
                           @csrf
                           @method('GET')
                           <button class="btn btn-danger" type="submit">Cancel</button>
                        </form>
                        <?php endif; ?>
                     </td>
                  <?php endif; ?>
                  
               </tr>
               @endforeach
            </tbody>
         </table>
         <?php  if(!empty($orders)): ?>
         {{ $orders->links() }}
         <?php endif; ?>
      </div>
   </div>
</div>
@endsection