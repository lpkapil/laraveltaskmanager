<?php

namespace App\Http\Controllers;

use App\Store;
use App\Category;
use App\Product;
use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            

            //Cart items count
            $cart = session()->get('cart');
            $cartItemsCount = 0;
            if(!empty($cart)) {
               foreach($cart as $item) {
                $cartItemsCount += $item['quantity'];
               } 
            }

            

            //Cart action empty cart
            if (!empty($request->action) && ($request->action == 'emptycart')) {
                $this->emptyCart($store);
                return view('customers.cart', ['store' => $store, 'cart' => [], 'cartitemcount' => 0]);
            }

            //Show page
            if (!empty($request->page) && empty($request->action)) {
                return $this->getPage($request->page, $store, $categories, $catId = $request->cat, $cartItemsCount);
            }

            //Cart action home page add
            if (
                !empty($request->action) && ($request->action == 'add') 
                && (!empty($request->product) && empty($request->page))
            ) {
                $this->addToCart($request->product, $store);
                return redirect('/'.$store->store_name);
            }

            // Cart action cart page only add/remove
            if (
                !empty($request->action) && ($request->action == 'add') 
                && !empty($request->page) && ($request->page == 'cart') 
                && (!empty($request->product))
            ) {

                $this->addToCart($request->product, $store);
                return redirect('/'.$store->store_name.'?page=cart');
            }

            if (
                !empty($request->action) && ($request->action == 'remove') 
                && !empty($request->page) && ($request->page == 'cart') 
                && (!empty($request->product))
            ) {
                $this->removeFromCart($request->product, $store);
                return redirect('/'.$store->store_name.'?page=cart');
            }
            
            return view('customers.index', ['store' => $store, 'categories' => $categories, 'cartitemcount' => $cartItemsCount]);
        
        } else {
            return redirect('/');
        }
    }

    /**
     * Route to Page
     */
    private function getPage($slug, $store, $categories, $catId = null, $cartItemsCount)
    {

        switch($slug)
        {
            case 'categories':
                return view(
                    'customers.categories',
                    [
                        'store' => $store,
                        'categories' => $categories,
                        'cartitemcount' => $cartItemsCount
                    ]
                );
            break;

            case 'products':
                $category = Category::where(['id' => $catId, 'user_id' => $store->user_id])->orderByDesc('id')->get()->first();
                $products = Product::where(['product_category_id' => $category->id])->orderByDesc('id')->get();
                return view(
                    'customers.products', 
                    [
                        'store' => $store,
                        'category' => $category,
                        'products' => $products,
                        'cartitemcount' => $cartItemsCount
                    ]
                );
            break;

            case 'cart':
                $cart = session()->get('cart');
                $itemsTotal = 0;
                $grandTotal = 0;
                $deliveryCharges = 10;
                $noDeliveryChargesAmt = 100;
                if(!empty($cart)) {
                    foreach($cart as $product) {
                        $itemsTotal +=  $product['quantity'] * $product['price'];
                    }
                }

                if ($itemsTotal >= $noDeliveryChargesAmt) {
                    $deliveryCharges = 0;
                }

                $grandTotal = $itemsTotal + $deliveryCharges;

                return view(
                    'customers.cart',
                    [
                        'store' => $store,
                        'cart' => $cart,
                        'cartitemcount' => $cartItemsCount,
                        'itemstotal' => $itemsTotal,
                        'nodevliverycharge' => $noDeliveryChargesAmt,
                        'deliverycharge' => $deliveryCharges,
                        'grandtotal' => $grandTotal
                    ]
                );
            break;

            case 'checkout':
                if (Auth::guest()):
                    return view('customers.register', ['store' => $store]);
                else:
                    $cart = session()->get('cart');
                    $itemsTotal = 0;
                    $grandTotal = 0;
                    $deliveryCharges = 10;
                    $noDeliveryChargesAmt = 100;
                    if(!empty($cart)) {
                        foreach($cart as $product) {
                            $itemsTotal +=  $product['quantity'] * $product['price'];
                        }
                    }

                    if ($itemsTotal >= $noDeliveryChargesAmt) {
                        $deliveryCharges = 0;
                    }

                    $grandTotal = $itemsTotal + $deliveryCharges;
                    return view(
                        'customers.checkout',
                        [
                            'store' => $store,
                            'cartitemcount' => $cartItemsCount,
                            'grandtotal' => $grandTotal
                        ]
                    );
                endif;
            break;

            case 'orders':
                if (Auth::guest()):
                    return view('customers.register', ['store' => $store]);
                else:
                    $cart = session()->get('cart');
                    $itemsTotal = 0;
                    $grandTotal = 0;
                    $deliveryCharges = 10;
                    $noDeliveryChargesAmt = 100;
                    if(!empty($cart)) {
                        foreach($cart as $product) {
                            $itemsTotal +=  $product['quantity'] * $product['price'];
                        }
                    }

                    if ($itemsTotal >= $noDeliveryChargesAmt) {
                        $deliveryCharges = 0;
                    }

                    $grandTotal = $itemsTotal + $deliveryCharges;

                    $orders = $orders = Order::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(4,['*'],'p');
                    return view(
                        'customers.orders',
                        [
                            'store' => $store,
                            'cartitemcount' => $cartItemsCount,
                            'orders' => $orders,
                        ]
                    );
                endif;
            break;

            default: return redirect('/'.$store->store_name);
        }
    }


    private function addToCart($productId, $store)
    {   
        $product = Product::where(['user_id' => $store->user_id, 'id' => $productId])->get()->first();
        if (!$product) {
            return redirect('/'.$store->store_name);
        }
        
        $cart = session()->get('cart');
        $storeSession = session()->get('store');
        if (!$storeSession) {
            session()->put(
                'store', 
                [
                    'store_id' => $store->id,
                    'store_name' => $store->store_name
                ]
            );
        }
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $productId => [
                        "name" => $product->product_name,
                        "quantity" => 1,
                        "price" => $product->product_price,
                        "photo" => $product->product_image,
                        'qty' => $product->product_quantity,
                        'qty_type' => $product->product_quantity_type
                    ]
            ];
            session()->put('cart', $cart);
            return;
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            session()->put('cart', $cart);
            return;
        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$productId] = [
            "name" => $product->product_name,
            "quantity" => 1,
            "price" => $product->product_price,
            "photo" => $product->product_image,
            'qty' => $product->product_quantity,
            'qty_type' => $product->product_quantity_type
        ];
        session()->put('cart', $cart);
        return;
    }

    private function removeFromCart($productId, $store)
    {
        $product = Product::where(['user_id' => $store->user_id, 'id' => $productId])->get()->first();
        if(!$product) {
            return redirect('/'.$store->store_name);
        }

        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
            return;
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$productId])) {
            if($cart[$productId]['quantity'] > 0) {
                $cart[$productId]['quantity']--;

                if($cart[$productId]['quantity'] == 0) {
                    unset($cart[$productId]);
                }

                session()->put('cart', $cart);
                return;
            } else {
                unset($cart[$productId]);
                session()->put('cart', $cart);
                return;
            }
        } else {
            return;
        }
    }

    /**
     * Empty cart
     */
    private function emptyCart($store)
    {
        session()->put('cart', []);
        session()->put('store', []);
        return;
    }

    /**
     * Place Order
     */
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart');
        $store = session()->get('store');
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:255',
            'phone'=>'required|string|max:255',
            'address'=>'required|string|max:255',
            'city'=>'required|string|max:255',
            'pincode'=>'required|string|max:255',
            'payment'=>'required|string|max:255|'.Rule::in(['cod']),
        ]);
        

        if ($validator->fails()) {
            return redirect('/'.$store['store_name'].'?page=checkout')->withErrors($validator)->withInput();
        }

        //redirect invalid request to clean cart
        if(empty($cart) || empty($store)) {
            $this->emptyCart([]);
            return redirect('/'.$store['store_name'].'?page=cart');
        }

        $itemsTotal = 0;
        $totalItems = 0;
        $grandTotal = 0;
        $deliveryCharges = 10;
        $noDeliveryChargesAmt = 100;
        if(!empty($cart)) {
            foreach($cart as $product) {
                $itemsTotal +=  $product['quantity'] * $product['price'];
                $totalItems +=  $product['quantity'];
            }
        }

        if ($itemsTotal >= $noDeliveryChargesAmt) {
            $deliveryCharges = 0;
        }

        $grandTotal = $itemsTotal + $deliveryCharges;        

        $order = new Order([
            'store_id' => $store['store_id'],
            'user_id' => Auth::user()->id,
            'status' => 'pending',
            'customer_name' => $request->get('name'),
            'customer_phone' => $request->get('phone'),
            'customer_address' => $request->get('address'),
            'customer_city' => $request->get('city'),
            'customer_pincode' => $request->get('pincode'),
            'items_count' => $totalItems,
            'payment_method' => $request->get('payment'),
            'subtotal' => $itemsTotal,
            'delivery_charge' => $deliveryCharges,
            'grand_total' => $grandTotal
        ]);

        $order->save();
        
        //Add order items 
        foreach($cart as $productId => $product) {
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => 'pending',
                'product_image' => $product['photo'],
                'product_qty' => $product['quantity'],
                'product_price' => $product['price']
            ]);
            $orderItem->save();
        }

        //Empty old cart
        $this->emptyCart([]);

        return redirect('/'.$store['store_name'].'?page=orders')->with('success', 'Order '.$order->id.' placed successfully!');
    }
}
