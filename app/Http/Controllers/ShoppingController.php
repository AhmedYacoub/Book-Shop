<?php

namespace App\Http\Controllers;

use Session;

use Cart;
use App\Product;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function cart() 
    {
        return view('products.cart');
    }

    public function add_to_cart(Request $request) 
    {
        // Find this product
        $product = Product::find($request->product_id);

        // Add it to cart
        $cartItem = Cart::add($product->id, $product->name, $request->quantity, $product->price);

        // Associate a cart item to a model
        Cart::associate($cartItem->rowId, Product::class);

        Session::flash('success', 'New item added to your cart!');

        // redirect back
        return redirect()->route('cart');
    }

    // Increment cart item by 1
    public function increment($id, $qty)
    {
        Cart::update($id, (int)$qty + 1);

        return redirect()->back();
    }

    // Decrement cart item by 1
    public function decrement($id, $qty)
    {
        if ((int)$qty != 0) {
            Cart::update($id, (int)$qty - 1);   
        }

        return redirect()->back();
    }

    // One click add item to cart
    public function rapid_add($id) {
        // find this item
        $product = Product::find($id);

        // add to cart
        $cart = Cart::add($product->id, $product->name, 1, $product->price);

        // associate this newly created product to Product model
        Cart::associate($cart->rowId, Product::class);

        return redirect('/cart');
    }


    public function remove_item_from_cart($id)
    {
        Cart::remove($id);

        Session::flash('info', 'Item removed from cart!');

        return redirect()->back();
    }
}
