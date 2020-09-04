<?php

namespace App\Http\Controllers;

use App\Store;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FrontSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {   
        $storeName = ltrim(parse_url(url()->previous())['path'], '/');
        $validator = Validator::make($request->all(), [
            'search'=>'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect('/');
        }

        $store = Store::where('store_name', $storeName)->get()->first();
        if (!empty($store)) {

            $categories = Category::where(['user_id' => $store->user_id])
            ->where('name', 'like', '%'.$request->get('search').'%')->orderByDesc('id')->get();
            
            $products = Product::where(['user_id' => $store->user_id])
            ->where(['product_status' => 1])
            ->where('product_name', 'like', '%'.$request->get('search').'%')->orderByDesc('id')->get();
            
            //Cart items count
            $cart = session()->get('cart');
            $cartItemsCount = 0;
            if(!empty($cart)) {
               foreach($cart as $item) {
                $cartItemsCount += $item['quantity'];
               } 
            }
            
            return view(
                'customers.search',
                [
                    'store' => $store,
                    'categories' => $categories,
                    'products' => $products,
                    'cartitemcount' => $cartItemsCount,
                    'searchtext' => $request->get('search')
                ]
            );
        
        } else {
            return redirect('/');
        }
    }
}
