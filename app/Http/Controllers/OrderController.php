<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('role:admin,user');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(in_array('admin', Auth::user()->roles->pluck('slug')->toArray())):
            $orders = Order::orderByDesc('id')->paginate(4);
        else:
            $store = Store::where('user_id', Auth::user()->id)->orderByDesc('id')->get()->first();
            if(!empty($store)) {
                $orders = Order::where('store_id', $store->id)->orderByDesc('id')->paginate(4);
            } else {
                $orders = [];
            }
        endif;
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect('/orders')->with('success', 'Order saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $requestData = explode("|", $id);
        $id = $requestData[0];
        $status = $requestData[1];
        $store = Store::where('user_id', Auth::user()->id)->orderByDesc('id')->get()->first();
        $order = Order::where(['id' => $id, 'store_id' => $store->id])->orderByDesc('id')->get()->first();
        if (empty($order)) {
            return redirect('/orders');
        }

        if(!in_array($status, ['accepted', 'shipped', 'delivered', 'declined', 'cancelled'])) {
            return redirect('/orders');
        }
        
        $order->status =  $status;
        $order->save();
        return redirect('/orders')->with('success', 'Order #'.$order->id.' status changed to '.$status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        return redirect('/orders')->with('success', 'Order updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('/orders')->with('success', 'Order deleted');
    }
}
