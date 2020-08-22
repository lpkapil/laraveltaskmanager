<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Storage;

class ProductController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->status = ['0', '1'];
        $this->qunatityTypes = [
            'piece',
            'kg',
            'gm',
            'litre',
            'ml',
            'dozen',
            'ft',
            'kg',
            'sq.ft.',
            'sq.meter',
            'set',
        ];
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(in_array('admin', Auth::user()->roles->pluck('slug')->toArray())):
            $products = Product::orderByDesc('id')->paginate(4);
        else:
            $products = Product::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(4);
        endif;
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::where('user_id', Auth::user()->id)->orderByDesc('id')->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('product_image');
        $validator = Validator::make($request->all(), [
            'product_category_id'=>'required|string|max:255'.Rule::in(Category::where('user_id', Auth::user()->id)->pluck('id')->toArray()),
            'product_name'=>'required|string|max:255',
            'product_mrp'=>'required|numeric|max:255',
            'product_price'=>'required|numeric|max:255|lt:product_mrp',
            'product_quantity'=>'required|string|max:255',
            'product_quantity_type'=>'required|string|max:255|'.Rule::in($this->qunatityTypes),
            'product_status'=>'required|string|max:255|'.Rule::in($this->status)
        ]);
        
        if (!empty($file)) {
            $validator = Validator::make($request->all(), [
                'product_image' => 'required|image|max:2000',
            ]);
        }
        
        if ($validator->fails()) {
            return redirect('products/create')->withErrors($validator)->withInput();
        }

        if (!empty($file)) {
            $request->file('product_image')->store('public/product_images');
            $fileName = $request->file('product_image')->hashName();    
        } else {
            $fileName = '';
        }

        $product = new Product([
            'user_id' => Auth::user()->id,
            'product_image' => $fileName,
            'product_category_id' => $request->get('product_category_id'),
            'product_name' => $request->get('product_name'),
            'product_mrp' => $request->get('product_mrp'),
            'product_price' => $request->get('product_price'),
            'product_quantity' => $request->get('product_quantity'),
            'product_quantity_type' => $request->get('product_quantity_type'),
            'product_description' => $request->get('product_description') ?? '',
            'product_status' => $request->get('product_status')
        ]);
        $product->save();
        return redirect('/products')->with('success', 'Product saved!');
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
        $product = Product::find($id);
        
        if ($product) {
            if (in_array('admin', Auth::user()->roles->pluck('slug')->toArray())):
                $categories = Category::where('user_id', $product->user_id)->orderByDesc('id')->get();
                return view('products.edit', ['product' => $product, 'categories' => $categories]);
            else:
                if ($product->user_id == Auth::user()->id):
                    $categories = Category::where('user_id', Auth::user()->id)->orderByDesc('id')->get();
                    return view('products.edit', ['product' => $product, 'categories' => $categories]);
                else:
                    return redirect('/products')->with('errors', 'Invalid Product to edit!');
                endif;    
            endif;
        } else {
            return redirect('/products')->with('errors', 'Invalid Product to edit!');
        }
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
        $product = Product::find($id);
        $file = $request->file('product_image');
        $validator = Validator::make($request->all(), [
            'product_category_id'=>'required|string|max:255|'.Rule::in(Category::where('user_id', Auth::user()->id)->pluck('id')->toArray()),
            'product_name'=>'required|string|max:255',
            'product_mrp'=>'required|numeric|max:255',
            'product_price'=>'required|numeric|max:255|lt:product_mrp',
            'product_quantity'=>'required|string|max:255',
            'product_quantity_type'=>'required|string|max:255|'.Rule::in($this->qunatityTypes),
            'product_status'=>'required|string|max:255|'.Rule::in($this->status)
        ]);

        if (!empty($file)) {
            $validator = Validator::make($request->all(), [
                'product_image' => 'required|image|max:2000',
            ]);
        }

        if ($validator->fails()) {
            return redirect('products/'.$id.'/edit')->withErrors($validator)->withInput();
        }

        if (!empty($file)) {
            //Delete old file
            Storage::delete('/public/product_images/' . $product->product_image);
            $request->file('product_image')->store('public/product_images');
            $fileName = $request->file('product_image')->hashName();    
        } else {
            $fileName = $product->product_image;
        }

        $product->product_image =  $fileName;
        $product->product_category_id = $request->get('product_category_id');
        $product->product_name = $request->get('product_name');
        $product->product_mrp = $request->get('product_mrp');
        $product->product_price = $request->get('product_price');
        $product->product_quantity = $request->get('product_quantity');
        $product->product_quantity_type = $request->get('product_quantity_type');
        $product->product_description = $request->get('product_description');
        $product->product_status = $request->get('product_status');
        $product->save();
        return redirect('/products')->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            Storage::delete('/public/product_images/' . $product->product_image);
            $product->delete();
            return redirect('/products')->with('success', 'Product deleted!');  
        } else {
            return redirect('/products')->with('errors', 'Invalid Product to delete!');
        }
    }
}
