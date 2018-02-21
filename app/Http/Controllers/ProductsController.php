<?php

namespace App\Http\Controllers;

use Session;
use Auth;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index')->with('products', Product::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'product_name'  => 'required|max:50',
            'product_price' => 'required',
            'product_description'   => 'required|max:500',
            'product_image' => 'required|image|mimes:jpeg,jpg,png|max:1999'
        ]);

        // Image path
        $product_image = $request->product_image;   // get image
        $product_image_new_name = time().$product_image->getClientOriginalName();   // change the uploaded image to new name (time + original_name)
        $product_image->move('uploads/products', $product_image_new_name);          // move the uploaded image to uploads/products directory

        // Creation
        Product::create([
            'name'  => $request->product_name,
            'slug'  => str_slug($request->product_name),
            'price' => $request->product_price,
            'description' => $request->product_description,
            'image' => 'uploads/products'.$product_image_new_name
        ]);

        // flash message
        Session::flash('success', 'Item created successfully!');
        return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('products.show')->with('product', Product::where('slug', $id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('slug', $id)->first();

        // delete record
        $product->delete();

        // delete image
        if( file_exists($product->image )) {
            unlink($product->image);
        }

        Session::flash('danger', 'Product deleted successfully!');
        return redirect()->back();
    }
}
