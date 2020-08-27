<?php

namespace App\Http\Controllers;

use App\Store;
use App\Category;
use App\Product;
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
    public function index(Request $request, $storeName)
    {   
        $store = Store::where('store_name', $storeName)->get()->first();
        
        if (!empty($store)) {
            
            $categories = Category::where('user_id', $store->user_id)->orderByDesc('id')->get();
            
            //Show page
            if (!empty($request->page)) {
                return $this->getPage($request->page, $store, $categories, $catId = $request->cat);
            }
            
            return view('customers.index', ['store' => $store, 'categories' => $categories]);
        
        } else {
            return redirect('/');
        }
    }

    /**
     * Route to Page
     */
    private function getPage($slug, $store, $categories, $catId = null)
    {

        switch($slug)
        {
            case 'categories':
                return view('customers.categories', ['store' => $store, 'categories' => $categories]);
            break;

            case 'products':
                $category = Category::where(['id' => $catId, 'user_id' => $store->user_id])->orderByDesc('id')->get()->first();
                $products = Product::where(['product_category_id' => $category->id])->orderByDesc('id')->get();
                return view('customers.products', ['store' => $store, 'category' => $category, 'products' => $products]);
            break;

            case 'cart':
                return view('customers.cart', ['store' => $store]);
            break;

            case 'orders':
                if (Auth::guest()):
                    return view('customers.register', ['store' => $store]);
                else:
                    return view('customers.orders', ['store' => $store]);
                endif;
            break;

            default: return redirect('/'.$store->store_name);
        }
    }
}
