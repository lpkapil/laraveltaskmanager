<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class FrontStoreController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($storeName)
    {   
        $store = Store::where('store_name', $storeName)->get()->first();
        if (!empty($store)) {
            return view('customers.index', ['store' => $store]);
        } else {
            return redirect('/');
        }
        
    }
}
