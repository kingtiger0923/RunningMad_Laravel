<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use DateTime;
use Input;
Use Auth;
use Storage;
use Mail;
Use App\Race;
Use App\Donor;
Use App\Donation;
Use App\Racer;
Use App\Order;
Use App\Coupon;
Use App\ShopOrder;
Use App\Shopcoupon;
Use Cart as Cart;
use Session;
use App\User;
Use App\Customer;
use Stripe\Stripe;
use Illuminate\Support\Facades\Validator;

class RaceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        //$races = Race::all();
         $races = Race::where('status', '=', "PUBLISHED")
         ->orderBy('created_at', 'desc')
         ->get();
        return view('race')->with(array('races'=> $races ));
    }

    /**
     * Loading single campaign
     */
    public function show($slug)
    {   
        $race = Race::where('slug', '=', $slug)->firstOrFail();
        return view('race-single')->with(array('race'=> $race));  
    }
    
    /**
     * Add to Cart
     */
    public function add_to_cart(Request $request)
    {   
        if($request->ajax()) {
            $data = $request->all();
            Cart::add($data['id'], $data['title'], $data['qty'], $data['amount'], ['image' => $data['image'], 'interval' => $data['interval'],'contribution' => $data['contribution'], 'flag' => $data['flag'],'charity' => $data['charity'],'coupon' => 0 ]);
        }
    }

    /**
     * Remove Cart Item.
     */
    public function remove_cart_item(Request $request)
    {   
        if($request->ajax()) {
            $data = $request->all();
            Cart::remove($data['rowid']);
        }
    }

    /**
     * Update Cart Item.
     */
    public function update_cart_item(Request $request)
    {   
        if($request->ajax()) {
            $data = $request->all();
            Cart::update($data['rowid'], $data['qty']);
            }
    }

    /**
     * Add coupon.
     */
    public function addcoupon(Request $request)
    {   
        if($request->ajax()) {
            $data = $request->all();
            $code = $data['code'];
            $coupon_valid = 0;
            $request->session()->forget('promocode.code');
            $promocode = Session::get('promocode.code');
            if (!$promocode){
                $items = Cart::content();
                foreach ($items as $key => $cart) {
                    $race_coupons = Coupon::where('code', $data['code'])
                        ->where('valid_till','>=', date("Y-m-d"))
                      ->get();
                    $shop_coupons = Shopcoupon::where('code', $data['code'])
                        ->where('valid_till','>=', date("Y-m-d"))
                      ->get();
                    if($cart->options->flag == 'shop'){ // for shop
                        if($shop_coupons) {
                        foreach ($shop_coupons as $key => $coupon) {
                            foreach ($coupon->products as $key => $row) {
                                if($row->id == $cart->id) {
                                    $coupon_valid = 1;
                                    $cart_price = $cart->price;
                                    if(strpos($coupon->value, '%') !== false) {
                                        Session::push('promocode.code', $code);
                                        $coupon_price = str_ireplace('%', '', $coupon->value);
                                        $discount = $cart_price*$coupon_price/100;
                                        $price = $cart_price - $discount;
                                    } else {
                                        Session::push('promocode.code', $code);
                                        $discount = $coupon->value;
                                        $price = $cart_price - $discount ;
                                    }
                                    Cart::update($cart->rowId,['options' => ['image' => $cart->options->image, 'interval' => $cart->options->interval,'coupon' => $discount,'contribution' => $cart->options->contribution, 'flag' => $cart->options->flag]]);
                                }
                           }
                        }
                        }
                    } else {
                        foreach ($race_coupons as $key => $coupon) { // for race
                            if($race_coupons) {
                            foreach ($coupon->races as $key => $row) {
                                if($row->id == $cart->id) {
                                    $coupon_valid = 1;
                                    $cart_price = $cart->price;
                                    if(strpos($coupon->value, '%') !== false) {
                                        Session::push('promocode.code', $code);
                                        $coupon_price = str_ireplace('%', '', $coupon->value);
                                        $discount = $cart_price*$coupon_price/100;
                                        $price = $cart_price - $discount;
                                    } else {
                                        Session::push('promocode.code', $code);
                                        $discount = $coupon->value;
                                        $price = $cart_price - $discount ;
                                    }
                                    Cart::update($cart->rowId,['options' => ['image' => $cart->options->image, 'interval' => $cart->options->interval,'coupon' => $discount,'contribution' => $cart->options->contribution, 'flag' => $cart->options->flag]]);
                                }
                            }
                            }
                        }
                    }
                }
            if($coupon_valid > 0) echo 'valid';
            else echo "invalid";
            } else echo "invalid";
        } 
    }

    /**
     * Add contribution
     */
    public function addcontribution(Request $request)
    {   
        if($request->ajax()) {
            $data = $request->all();
            $contribution = $data['contribution'];
            $cart = Cart::get($data['rowid']);
            Cart::update($data['rowid'],['options' =>['image' => $cart->options->image, 'interval' => $cart->options->interval,'coupon' => $cart->options->coupon,'contribution' => $contribution, 'flag' => $cart->options->flag]]);
            echo 'valid';
        }
    }     

    /*******stripe single payment stats*********/
    public function createIntent()
    {  
        $total_contribution = 0;
        $total_coupon = 0;
        foreach(Cart::content() as $row){
            if($row->options->contribution)
                $total_contribution += $row->options->contribution;
            if($row->options->coupon)
                $total_coupon += $row->options->coupon;
        }
    	$amount = Cart::subtotal();
    	$amount = str_replace(",","", ($amount+$total_contribution)-$total_coupon);
        $amount = number_format((float)$amount, 2, '.', '');   
        $amount = $amount*100;

	 	$s = new Stripe_sca();
        $s->url .= 'payment_intents';
        $s->fields['amount'] = $amount; // 
        $s->fields['currency'] = 'gbp'; // 
        $intent = $s->call();
        // echo "<pre>"; print_r($intent); 
        $client_secret = $intent['client_secret'];
        return $client_secret;
    }
    
    // Stripe payment success
    public function chkprocess(Request $request)
    {
        if($request->ajax()) {
            $order = Session::get('order');
            $items = Cart::content();
            $reference = substr(md5(mt_rand()), 0, 8);
            $name = array();
            // print_r($order);
            $now = new DateTime();
            if(Auth::guest()){ //new user
                $last_user_id =User::create([
                    'name' => $order['firstname'].$order['lastname'],
                    'email' => $order['email'],
                    'password' => bcrypt($order['password']),
                ]);

                // add shipping address
                Customer::create([
                    'user_id' => $last_user_id->id,
                    'postcode' => $order['postcode'],
                    'city' => $order['city'],
                    'address' => $order['address'],
                    'country' => $order['country'],
                    'phone' => $order['phone'],
                ]);

                // sending welcome message after registration
                $sender_name =  $order['firstname']." ".$order['lastname'];
                $sender_email = $order['email'];
                Mail::send('emails.registration', array('data'=>$order), function ($message) use ($sender_name, $sender_email) {
                    $message->from('hello@runningmad.co.uk', 'Runningmad');
                    $message->subject('Welcome to Runningmad');
                    $message->to($sender_email);
                });

                // racer data
                $racer = new Racer;
                $racer->firstname = $order['firstname'];
                $racer->lastname = $order['lastname'];
                $racer->email = $order['email'];
                $racer->postcode = $order['postcode'];
                $racer->phone = $order['phone'];
                $racer->city = $order['city'];
                $racer->address = $order['address'];
                $racer->country = $order['country'];            
                $racer->save();
                $LastInsertId = $racer->id;
            } else { // existing user
                $user = Auth::user();
                $last_user_id = $user;
    
                if(strpos($user->name, ' ') !== false){
                    $name = explode(" ",$user->name);
                } else{
                    $name[0] = $user->name;
                    $name[1] = '';
                }
                // print_r($name);

                Customer::where('user_id', $user->id)->update(['address' => $order['address'],'city' => $order['city'],'postcode' => $order['postcode'], 'country' => $order['country']]);

                $racer = new Racer;
                $racer->firstname = $name['0'];
                $racer->lastname = $name['1'];
                $racer->email = $user->email;
                $racer->phone =   $order['phone'];;
                if(isset($order['sameasbilling'])){
                    $racer->postcode = $order['postcode'];
                    $racer->city = $order['city'];
                    $racer->address = $order['address'];
                    $racer->country = $order['country'];
                } else {
                    $racer->postcode = $order['shipping_postcode'];
                    $racer->city = $order['shipping_city'];
                    $racer->address = $order['shipping_address'];
                    $racer->country = $order['shipping_country'];
                }           
                $racer->save();
                $LastInsertId = $racer->id;
            }

        $i=0;
        $interval = "";
        $shop_data =  array();
        $donation_data = array();

        foreach($items as $row): 
            foreach ($row as $key => $value) {
                if($row->options->flag == 'race'){
                    $donation_data[$i]['racer_id'] = $LastInsertId;
                    $donation_data[$i]['user_id'] = $last_user_id->id;
                    if($key == 'id') $donation_data[$i]['race_id'] = $value;
                    if($key == 'price') $donation_data[$i]['amount'] = $value;
                    $donation_data[$i]['quantity'] = $row->qty;
                    $donation_data[$i]['currency'] = 'gbp';
                    if($row->options->contribution)
                    $donation_data[$i]['contribution'] = $row->options->contribution;
                    else 
                    $donation_data[$i]['contribution'] = 0;

                    if($row->options->coupon)
                    $donation_data[$i]['discount'] = $row->options->coupon;
                    else 
                    $donation_data[$i]['discount'] = 0;

                    if($row->options->charity)
                    $donation_data[$i]['charity'] = $row->options->charity;
                    else 
                    $donation_data[$i]['charity'] = '-';
                   
                    if(Auth::guest()){ 
                        $donation_data[$i]['firstname'] = $order['firstname'];
                        $donation_data[$i]['lastname'] = $order['lastname'];
                        $donation_data[$i]['email'] = $order['email'];
                    } else {
                        $user = Auth::user();
                        $donation_data[$i]['firstname'] =  $name['0'];
                        $donation_data[$i]['lastname'] =  $name['1'];
                        $donation_data[$i]['email'] = $user->email;
                    }
                   
                    $donation_data[$i]['postcode'] = $order['postcode'];
                    $donation_data[$i]['city'] = $order['city'];
                    $donation_data[$i]['address'] = $order['address'];
                    $donation_data[$i]['country'] = $order['country'];
                   
                    if(isset($order['sameasbilling'])){
                        $donation_data[$i]['delivery_postcode'] = $order['postcode'];
                        $donation_data[$i]['delivery_city'] = $order['city'];
                        $donation_data[$i]['delivery_address'] = $order['address'];
                        $donation_data[$i]['delivery_country'] = $order['country'];
                    } else {
                        $donation_data[$i]['delivery_postcode'] = $order['shipping_postcode'];
                        $donation_data[$i]['delivery_city'] = $order['shipping_city'];
                        $donation_data[$i]['delivery_address'] = $order['shipping_address'];
                        $donation_data[$i]['delivery_country'] = $order['shipping_country'];
                    }
                   
                    $donation_data[$i]['phone'] = $order['phone'];
                    $donation_data[$i]['status'] = "Awaiting for evidence";
                    $donation_data[$i]['reference'] = $reference;
                    $donation_data[$i]['created_at'] =$now;
                    $donation_data[$i]['updated_at'] = $now;

                    $cart_data[$i]['name'] = $row->name;
                    // $cart_data[$i]['type'] = $row->options->interval;
                    $cart_data[$i]['price'] = $row->price;
                    $cart_data[$i]['quantity'] = $row->qty;           
                    $cart_data[$i]['image'] = $row->options->image;
                    $cart_data[$i]['contribution'] = $row->options->contribution;
                }  
                if($row->options->flag == 'shop'){
                    $shop_data[$i]['racer_id'] = $LastInsertId;
                    $shop_data[$i]['user_id'] = $last_user_id->id;
                    if($key == 'id') $shop_data[$i]['product_id'] = $value;
                    if($key == 'price') $shop_data[$i]['amount'] = $value;
                    $shop_data[$i]['quantity'] = $row->qty;
                    $shop_data[$i]['currency'] = 'gbp';
                    if($row->options->contribution)
                    $shop_data[$i]['contribution'] = $row->options->contribution;
                    else 
                    $shop_data[$i]['contribution'] = 0;

                    if($row->options->coupon)
                    $shop_data[$i]['discount'] = $row->options->coupon;
                    else 
                    $shop_data[$i]['discount'] = 0;
                   
                    if(Auth::guest()){ 
                        $shop_data[$i]['firstname'] = $order['firstname'];
                        $shop_data[$i]['lastname'] = $order['lastname'];
                        $shop_data[$i]['email'] = $order['email'];
                    } else {
                        $user = Auth::user();
                        $shop_data[$i]['firstname'] =  $name['0'];
                        $shop_data[$i]['lastname'] =  $name['1'];
                        $shop_data[$i]['email'] = $user->email;
                    }
                   
                    $shop_data[$i]['postcode'] = $order['postcode'];
                    $shop_data[$i]['city'] = $order['city'];
                    $shop_data[$i]['address'] = $order['address'];
                    $shop_data[$i]['country'] = $order['country'];
                   
                    if(isset($order['sameasbilling'])){
                        $shop_data[$i]['delivery_postcode'] = $order['postcode'];
                        $shop_data[$i]['delivery_city'] = $order['city'];
                        $shop_data[$i]['delivery_address'] = $order['address'];
                        $shop_data[$i]['delivery_country'] = $order['country'];
                    } else {
                        $shop_data[$i]['delivery_postcode'] = $order['shipping_postcode'];
                        $shop_data[$i]['delivery_city'] = $order['shipping_city'];
                        $shop_data[$i]['delivery_address'] = $order['shipping_address'];
                        $shop_data[$i]['delivery_country'] = $order['shipping_country'];
                    }
                   
                    $shop_data[$i]['phone'] = $order['phone'];
                    $shop_data[$i]['status'] = "Awaiting for evidence";
                    $shop_data[$i]['reference'] = $reference;
                    $shop_data[$i]['created_at'] =$now;
                    $shop_data[$i]['updated_at'] = $now;

                    $cart_data[$i]['name'] = $row->name;
                    // $cart_data[$i]['type'] = $row->options->interval;
                    $cart_data[$i]['price'] = $row->price;
                    $cart_data[$i]['quantity'] = $row->qty;           
                    $cart_data[$i]['image'] = $row->options->image;
                    $cart_data[$i]['contribution'] = $row->options->contribution;
                }
            }
        $i++;
        endforeach;

        if($shop_data)
            ShopOrder::insert($shop_data);
        if($donation_data)
            Order::insert($donation_data);
        $orderid = DB::getPdo()->lastInsertId(); 
        $orderid = DB::getPdo()->lastInsertId();

        // update to the database
        foreach ($donation_data as $key => $value) {
            Race::where('id',$donation_data[$key]['race_id'])
            ->decrement('total_medals',1);
             Race::where('id',$donation_data[$key]['race_id'])
            ->decrement('bought',1);
        }

        $this->send_email($order, $donation_data,$items,$orderid);

        Cart::destroy();
        Session::forget('promocode.code');
        echo "SUCCESS";
        }
    }

     /**
     * Checkout with Stripe.
     */
    public function pd_process(Request $request)
    {    
        //if(Cart::count()<1){ return "empty"; }
        if(Auth::guest()){
            $validatedData = $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'postcode' => 'required|max:255',
            'cart' => 'required|min:2'
        ],['cart.required'=>'Cart is empty']);
        } else {
            $validatedData = $request->validate([
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'postcode' => 'required|max:255',
            'cart' => 'required|min:2'
        ],['cart.required'=>'Cart is empty']);
        }
       // print_r($validatedData);
        $order = $request->all();
        Session::put('order', $order);
        //echo "SUCCESS";
        $client_secret = $this->createIntent();
        return view('payment')->with(array('client_secret'=> $client_secret));
            
    }

    /**
     * PayPal payment success
     */
    public function paypalPayment()
    {
        $order = Session::get('order');
        //echo $order['sameasbilling'];
        $items = Cart::content();
        $reference = substr(md5(mt_rand()), 0, 8);
        $name = array();
        // print_r($order);
        $now = new DateTime();

        if(Auth::guest()){ //new user
            $last_user_id =User::create([
                'name' => $order['firstname'].$order['lastname'],
                'email' => $order['email'],
                'password' => bcrypt($order['password']),
            ]);

            // add shipping address
            Customer::create([
                'user_id' => $last_user_id->id,
                'postcode' => $order['postcode'],
                'city' => $order['city'],
                'address' => $order['address'],
                'country' => $order['country'],
                'phone' => $order['phone'],
            ]);

            // sending welcome message after registration
            $sender_name =  $order['firstname']." ".$order['lastname'];
            $sender_email = $order['email'];
            Mail::send('emails.registration', array('data'=>$order), function ($message) use ($sender_name, $sender_email) {
                $message->from('hello@runningmad.co.uk', 'Runningmad');
                $message->subject('Welcome to Runningmad');
                $message->to($sender_email);
            });

            // racer data
            $racer = new Racer;
            $racer->firstname = $order['firstname'];
            $racer->lastname = $order['lastname'];
            $racer->email = $order['email'];
            $racer->postcode = $order['postcode'];
            $racer->phone = $order['phone'];
            $racer->city = $order['city'];
            $racer->address = $order['address'];
            $racer->country = $order['country'];            
            $racer->save();
            $LastInsertId = $racer->id;
        } else { // existing user
            $user = Auth::user();
            $last_user_id = $user;

            if(strpos($user->name, ' ') !== false){
                $name = explode(" ",$user->name);
            } else{
                $name[0] = $user->name;
                $name[1] = '';
            }
            // print_r($name);

            Customer::where('user_id', $user->id)->update(['address' => $order['address'],'city' => $order['city'],'postcode' => $order['postcode'], 'country' => $order['country']]);

            $racer = new Racer;
            $racer->firstname = $name['0'];
            $racer->lastname = $name['1'];
            $racer->email = $user->email;
            $racer->phone =   $order['phone'];;
            if(isset($order['sameasbilling'])){
                $racer->postcode = $order['postcode'];
                $racer->city = $order['city'];
                $racer->address = $order['address'];
                $racer->country = $order['country'];
            } else {
                $racer->postcode = $order['shipping_postcode'];
                $racer->city = $order['shipping_city'];
                $racer->address = $order['shipping_address'];
                $racer->country = $order['shipping_country'];
            }           
            $racer->save();
            $LastInsertId = $racer->id;
        }

        $i=0;
        $interval = "";
        $shop_data =  array();
        $donation_data = array();

        foreach($items as $row): 
            foreach ($row as $key => $value) {
                if($row->options->flag == 'race'){
                    $donation_data[$i]['racer_id'] = $LastInsertId;
                    $donation_data[$i]['user_id'] = $last_user_id->id;
                    if($key == 'id') $donation_data[$i]['race_id'] = $value;
                    if($key == 'price') $donation_data[$i]['amount'] = $value;
                    $donation_data[$i]['quantity'] = $row->qty;
                    $donation_data[$i]['currency'] = 'gbp';
                    if($row->options->contribution)
                    $donation_data[$i]['contribution'] = $row->options->contribution;
                    else 
                    $donation_data[$i]['contribution'] = 0;

                    if($row->options->coupon)
                    $donation_data[$i]['discount'] = $row->options->coupon;
                    else 
                    $donation_data[$i]['discount'] = 0;

                    if($row->options->charity)
                    $donation_data[$i]['charity'] = $row->options->charity;
                    else 
                    $donation_data[$i]['charity'] = '-';
                   
                    if(Auth::guest()){ 
                        $donation_data[$i]['firstname'] = $order['firstname'];
                        $donation_data[$i]['lastname'] = $order['lastname'];
                        $donation_data[$i]['email'] = $order['email'];
                    } else {
                        $user = Auth::user();
                        $donation_data[$i]['firstname'] =  $name['0'];
                        $donation_data[$i]['lastname'] =  $name['1'];
                        $donation_data[$i]['email'] = $user->email;
                    }
                   
                    $donation_data[$i]['postcode'] = $order['postcode'];
                    $donation_data[$i]['city'] = $order['city'];
                    $donation_data[$i]['address'] = $order['address'];
                    $donation_data[$i]['country'] = $order['country'];
                   
                    if(isset($order['sameasbilling'])){
                        $donation_data[$i]['delivery_postcode'] = $order['postcode'];
                        $donation_data[$i]['delivery_city'] = $order['city'];
                        $donation_data[$i]['delivery_address'] = $order['address'];
                        $donation_data[$i]['delivery_country'] = $order['country'];
                    } else {
                        $donation_data[$i]['delivery_postcode'] = $order['shipping_postcode'];
                        $donation_data[$i]['delivery_city'] = $order['shipping_city'];
                        $donation_data[$i]['delivery_address'] = $order['shipping_address'];
                        $donation_data[$i]['delivery_country'] = $order['shipping_country'];
                    }
                   
                    $donation_data[$i]['phone'] = $order['phone'];
                    $donation_data[$i]['status'] = "Awaiting for evidence";
                    $donation_data[$i]['reference'] = $reference;
                    $donation_data[$i]['created_at'] =$now;
                    $donation_data[$i]['updated_at'] = $now;

                    $cart_data[$i]['name'] = $row->name;
                    // $cart_data[$i]['type'] = $row->options->interval;
                    $cart_data[$i]['price'] = $row->price;
                    $cart_data[$i]['quantity'] = $row->qty;           
                    $cart_data[$i]['image'] = $row->options->image;
                    $cart_data[$i]['contribution'] = $row->options->contribution;
                }  
                if($row->options->flag == 'shop'){
                    $shop_data[$i]['racer_id'] = $LastInsertId;
                    $shop_data[$i]['user_id'] = $last_user_id->id;
                    if($key == 'id') $shop_data[$i]['product_id'] = $value;
                    if($key == 'price') $shop_data[$i]['amount'] = $value;
                    $shop_data[$i]['quantity'] = $row->qty;
                    $shop_data[$i]['currency'] = 'gbp';
                    if($row->options->contribution)
                    $shop_data[$i]['contribution'] = $row->options->contribution;
                    else 
                    $shop_data[$i]['contribution'] = 0;

                    if($row->options->coupon)
                    $shop_data[$i]['discount'] = $row->options->coupon;
                    else 
                    $shop_data[$i]['discount'] = 0;
                   
                    if(Auth::guest()){ 
                        $shop_data[$i]['firstname'] = $order['firstname'];
                        $shop_data[$i]['lastname'] = $order['lastname'];
                        $shop_data[$i]['email'] = $order['email'];
                    } else {
                        $user = Auth::user();
                        $shop_data[$i]['firstname'] =  $name['0'];
                        $shop_data[$i]['lastname'] =  $name['1'];
                        $shop_data[$i]['email'] = $user->email;
                    }
                   
                    $shop_data[$i]['postcode'] = $order['postcode'];
                    $shop_data[$i]['city'] = $order['city'];
                    $shop_data[$i]['address'] = $order['address'];
                    $shop_data[$i]['country'] = $order['country'];
                   
                    if(isset($order['sameasbilling'])){
                        $shop_data[$i]['delivery_postcode'] = $order['postcode'];
                        $shop_data[$i]['delivery_city'] = $order['city'];
                        $shop_data[$i]['delivery_address'] = $order['address'];
                        $shop_data[$i]['delivery_country'] = $order['country'];
                    } else {
                        $shop_data[$i]['delivery_postcode'] = $order['shipping_postcode'];
                        $shop_data[$i]['delivery_city'] = $order['shipping_city'];
                        $shop_data[$i]['delivery_address'] = $order['shipping_address'];
                        $shop_data[$i]['delivery_country'] = $order['shipping_country'];
                    }
                   
                    $shop_data[$i]['phone'] = $order['phone'];
                    $shop_data[$i]['status'] = "Awaiting for evidence";
                    $shop_data[$i]['reference'] = $reference;
                    $shop_data[$i]['created_at'] =$now;
                    $shop_data[$i]['updated_at'] = $now;

                    $cart_data[$i]['name'] = $row->name;
                    // $cart_data[$i]['type'] = $row->options->interval;
                    $cart_data[$i]['price'] = $row->price;
                    $cart_data[$i]['quantity'] = $row->qty;           
                    $cart_data[$i]['image'] = $row->options->image;
                    $cart_data[$i]['contribution'] = $row->options->contribution;
                }
            }
        $i++;
        endforeach;
        if($shop_data)
            ShopOrder::insert($shop_data);
        if($donation_data)
            Order::insert($donation_data);
        $orderid = DB::getPdo()->lastInsertId(); 

        // update to the database
        foreach ($donation_data as $key => $value) {
            Race::where('id',$donation_data[$key]['race_id'])
            ->decrement('total_medals',1);
             Race::where('id',$donation_data[$key]['race_id'])
            ->decrement('bought',1);
        }

        $this->send_email($order, $donation_data,$items,$orderid);
        Cart::destroy();
        Session::forget('promocode.code');
        return view('paypal-success');
    }

    /**
     * PayPal payment process
     */
    public function paypalPaymentProcess(Request $request)
    {
        if(Auth::guest()){
            $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'postcode' => 'required|max:255',
            'cart' => 'required|min:2'
        ],['cart.required'=>'Cart is empty']);
        } else {
            $validator = Validator::make($request->all(), [
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'postcode' => 'required|max:255',
            'cart' => 'required|min:2'
            ],['cart.required'=>'Cart is empty']);
        }
        // print_r($validatedData);
        if ($validator->passes()) {
            $order = $request->all();
            Session::put('order', $order);
            echo "SUCCESS";
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function send_email($order,$donation_data,$cart_data,$orderid )
    {
         if(Auth::guest()) {
	        $sender_name = $order['firstname'];
	        $sender_email = $order['email'];
         } else { // existing user
	    	$user = Auth::user();
			$sender_name =  $user->name;
	        $sender_email = $user->email;
		}
        Mail::send('emails.thankyou', array('order'=>$order ,'donation_data'=>$donation_data, 'cart_data'=>$cart_data ,'orderid'=>$orderid ), function ($message) use ($sender_name, $sender_email) {
            $message->from('hello@runningmad.co.uk', 'Runningmad');
            $message->subject('Thank you');
            $message->to($sender_email);
        });

        Mail::send('emails.admin', array('order'=>$order ,'donation_data'=>$donation_data, 'cart_data'=>$cart_data ,'orderid'=>$orderid ), function ($message) use ($sender_name, $sender_email) {
            $message->from($sender_email, $sender_name);
            $message->subject('Runningmad Order');
            $message->to('hello@runningmad.co.uk');
        });

        // check for failures
        if (Mail::failures()) {
            return "Your order is submitted successfully. Something went wrong when sending email.";
        }
    }

}

/**********Stripe class starts*************************/
class Stripe_sca {
    public $headers;
    public $url = 'https://api.stripe.com/v1/';
    public $fields = array();
    public $secret_key = "sk_live_Zga7XrTdN8VToPtKmVssYYRx00YxCCVG70"; // Runningmad secret_key
     
    function __construct () {
        $this->headers = array('Authorization: Bearer sk_live_Zga7XrTdN8VToPtKmVssYYRx00YxCCVG70'); // STRIPE_API_KEY = your stripe api key
    }

    function call () {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true); // return php array with api response
    }
}

/**********Stripe class ends*************************/

