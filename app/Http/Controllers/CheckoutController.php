<?php

namespace App\Http\Controllers;

use Session;
use Mail;
use Cart;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;


class CheckoutController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		if (Cart::total() == 0) {
            return redirect('/');
        }

		return view('products.checkout');
	}

	public function pay(Request $request)
	{
		// Set stripe API key
		// For more info: https://stripe.com/docs/quickstart
		Stripe::setApiKey("sk_test_z56nypK2XdLqDQiwHdIzLXpP");

		$charge = Charge::create([
			'amount'	=> Cart::total() * 100,
			'currency'	=> 'usd',
			'description' => 'Book Shop, New book payment',
			'source'	=> 	$request->stripeToken
		]);

		
		Session::flash('success', 'Successfull purchase, please check your email.');
		
		Cart::destroy();	// remove items from cart

		Mail::to($request->stripeEmail)->send(new \App\Mail\PurchaseSuccessfull);

		return redirect('/');
	}
}
