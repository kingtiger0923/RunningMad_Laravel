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

// Home
Route::get('/', 'HomeController@index');

// Campaign
Route::get('races', 'RaceController@index');
Route::get('race/{slug}','RaceController@show');

// cart
Route::get('/cart', function () {
   return view('cart');
 });

// Checkout
Route::get('checkout','PageController@checkout');

// Contact
Route::get('contact','PageController@contact');

// contact form process
Route::post('processcontact', ['uses' => 'PageController@processcontact']);

// About
Route::get('about','PageController@about');

// Services
Route::get('services','PageController@services');

// Page
Route::get('page','PageController@index');
Route::get('page/{slug}','PageController@show');

// Dashboard
Route::get('dashboard','DashboardController@index');
Route::post('updateprofile','DashboardController@update_profile');
Route::get('order/{slug}','DashboardController@show');
Route::post('evidenceprocess', ['uses' => 'DashboardController@evidenceprocess']);

// Cart
Route::get('/cart', function () { return view('cart'); });

// Add to cart
Route::post('addtocart', ['uses' => 'RaceController@add_to_cart']);
// Remove from cart
Route::post('removefromcart', ['uses' => 'RaceController@remove_cart_item']);
// update cart qty
Route::post('update_qty', ['uses' => 'RaceController@update_cart_item']);
// Add coupon
Route::post('addcoupon', ['uses' => 'RaceController@addcoupon']);
// Add contribution
Route::post('addcontribution', ['uses' => 'RaceController@addcontribution']);
// Checkout process
Route::post('chkprocess', ['uses' => 'RaceController@chkprocess']);
Route::get('success', function () {
	return view('success');
});
// About
Route::get('thankyou', function () {
    return view('thankyou');
});

// Paypal
Route::post('paypalpaymentprocess', array('uses'=>'RaceController@paypalPaymentProcess'));
Route::get('payment-status', array('uses'=>'RaceController@paypalPayment'));

Route::get('payment-cancel', function () {
   return view('paypal-cancel');
});

Route::post('payment', ['uses' => 'RaceController@pd_process']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Shop Page
Route::get('shop', array('uses'=>'ShopController@index'));

// Shop Single Page
Route::get('shop/{slug}', array('uses'=>'ShopController@show'));

// Google Login
Route::get('login/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('login/google/callback', 'Auth\GoogleController@handleGoogleCallback');

// FaceBook Login
Route::get('login/facebook', 'Auth\FaceBookController@redirectToFaceBook');
Route::get('login/facebook/callback', 'Auth\FaceBookController@handleFaceBookCallback');

Auth::routes();