<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontEndController@index');

Route::resource('products', 'ProductsController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Cart routes
Route::get('/cart', [
    'uses'  => 'ShoppingController@cart',
    'as'    => 'cart'
]);

Route::post('/cart/add', [
    'uses'  => 'ShoppingController@add_to_cart',
    'as'    => 'cart.add'
]);

Route::get('/cart/increment/{id}/{qty}', [
	'uses'	=> 'ShoppingController@increment',
	'as'	=> 'cart.increment'
]);

Route::get('/cart/decrement/{id}/{qty}', [
	'uses'	=> 'ShoppingController@decrement',
	'as'	=> 'cart.decrement'
]);

Route::get('/cart/rapid_add/{id}', [
	'uses'	=> 'ShoppingController@rapid_add',
	'as'	=> 'cart.rapid_add'
]);

Route::get('/cart/checkout', [
	'uses'	=> 'CheckoutController@index',
	'as'	=> 'cart.checkout'
]);

Route::post('/cart/checkout',[
	'uses'	=> 'CheckoutController@pay',
	'as'	=> 'cart.checkout'
]);

Route::get('cart/remove/{id}', [
	'uses'	=> 'ShoppingController@remove_item_from_cart',
	'as'	=> 'cart.remove'
]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
