<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (in_array('admin', Auth::user()->roles->pluck('slug')->toArray())):
            $stores = Store::orderByDesc('id')->paginate(4);
        else:
            $stores = Store::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(4);
        endif;
        return view('stores.index', compact('stores'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stores.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $store = Store::find($id);
        
        if ($store) {
            if ($store->user_id == Auth::user()->id):
                return view('stores.edit', compact('store'));
            else:
                return redirect('/stores')->with('errors', 'Invalid store to edit!');
            endif;
        } else {
            return redirect('/stores')->with('errors', 'Invalid store to edit!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'store_name'=> 'required|string|max:255|unique:stores,store_name',
        ]);

        if ($validator->fails()) {
            return redirect('stores/create')->withErrors($validator)->withInput();
        }

        $store = new Store([
            'user_id' => Auth::user()->id,
            'store_logo' => $request->get('store_logo') ?? '',
            'store_name' => $request->get('store_name'),
            'store_description' => $request->get('store_description') ?? '',
            'store_address' => $request->get('store_address') ?? '',
        ]);
        $store->save();
        return redirect('/stores')->with('success', 'Store saved!');
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
        $store = Store::find($id);
        $validator = Validator::make($request->all(), [
            'store_name'=> 'required|string|max:255|unique:stores,store_name,'.$store->id,
        ]);

        if ($validator->fails()) {
            return redirect('stores/create')->withErrors($validator)->withInput();
        }
        
        $store->store_name =  $request->get('store_name');
        $store->store_logo = $request->get('store_logo') ?? '';
        $store->store_description = $request->get('store_description') ?? '';
        $store->store_address = $request->get('store_address') ?? '';
        $store->save();
        return redirect('/stores')->with('success', 'Store updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        //Allow admin role to delete only
        if (!in_array('admin', Auth::user()->roles->pluck('slug')->toArray())):
            return redirect('/stores')->with('errors', 'Access denied!');
        endif;    

        $store = Store::find($id);
        if ($store) {
            $store->delete();
            return redirect('/stores')->with('success', 'Store deleted!');  
        } else {
            return redirect('/stores')->with('errors', 'Invalid store to delete!');
        }
    }
}
