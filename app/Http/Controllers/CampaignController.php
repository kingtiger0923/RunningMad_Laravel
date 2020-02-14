<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use DateTime;
use Input;
Use Auth;
use Storage;
Use App\Event;
Use App\Campaign;
Use App\Catgory;
Use App\Donor;
Use App\Donation;
Use App\Post;
Use Cart as Cart;
use Session;


class CampaignController extends Controller
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
        $data = Campaign::all();
        return view('campaign')->with(array('data'=> $data ));
    }

    /**
     * Loading single campaign
     */
    public function show($slug)
    {   
        $campaign = Campaign::where('slug', '=', $slug)->firstOrFail();
        $data = Campaign::all();
        return view('campaign-single')->with(array('campaign'=> $campaign, 'campaigns'=> $data));
       
    }

    /**
     * Add to Cart
     */
    public function add_to_cart(Request $request)
    {   
        if($request->ajax()) {
            $data = $request->all();
            Cart::add($data['id'], $data['title'], 1, $data['amount'], ['image' => $data['image'], 'interval' => $data['interval'] ]);
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

    
    /*******stripe recurring payment starts*******/

    public function create_plan($currency,$amount_monthly)
    {
        $s = new Stripe();
        $s->url .= 'plans';
        $s->fields['product'] = array('name' => 'Human Care Syria Plan');
        $s->fields['id'] = uniqid();
        $s->fields['interval'] = "month";
        $s->fields['currency'] = $currency;
        $s->fields['amount'] = $amount_monthly;
        $plan = $s->call();
        return $plan['id'];
    }

    public function create_customer($customer_email,$order)
    {
        $s = new Stripe();
        $s->url .= 'customers';
        $s->fields['email'] = $customer_email;
        $s->fields['source'] = array(
            'object' => 'card',
            'exp_month' => $order['edm'],
            'exp_year' => $order['edy'],
            'number' => $order['cardno'],
            'cvc' => $order['cvc']
        );
        $customer = $s->call();
        return $customer['id'];
    }

    public function create_subscription($customer_id, $plan_id, $order=array())
    {
        $s = new Stripe();
        $s->url .= 'customers/'.$customer_id.'/subscriptions';
        $s->fields['items'] = array(array('plan' => $plan_id));
        return $subscription_output = $s->call();        
    }

    /*******stripe recurring payment ends*******/

    /*******stripe single payment stats*********/

    public function create_oneoff_payment($currency, $amount_single, $order=array())
    {
        $s = new Stripe();
        $s->url .= 'charges';
        $s->fields['amount'] = $amount_single; // 
        $s->fields['currency'] = $currency; // 
        // credit card details
        $s->fields['source'] = array(
            'object' => 'card',
            'number' => $order['cardno'],
            'exp_month' => $order['edm'],
            'exp_year' => $order['edy'],
            'cvc' => $order['cvc'],
            'name' => $order['usernameincard'],
            'address' => $order['address'],
            'address_city' => $order['city'],
            'address_state' => '',
            'address_zip' => $order['postcode'],
            'address_country' => $order['country']
            // 'currency' => 'usd',
             // "amount" => 350,
        );
        return $oneoff_output = $s->call();         
    }

    public function create_oneoff_payment2($currency, $amount_single, $order=array())
    {
        $ss = new Stripe2();
        $ss->url .= 'charges';
        $ss->fields['amount'] = $amount_single; // 
        $ss->fields['currency'] = $currency; // 
        // credit card details
        $ss->fields['source'] = array(
            'object' => 'card',
            'number' => $order['cardno'],
            'exp_month' => $order['edm'],
            'exp_year' => $order['edy'],
            'cvc' => $order['cvc'],
            'name' => $order['usernameincard'],
            'address' => $order['address'],
            'address_city' => $order['city'],
            'address_state' => '',
            'address_zip' => $order['postcode'],
            'address_country' => $order['country']
            // 'currency' => 'usd',
             // "amount" => 350,
        );
        return $oneoff_output = $ss->call();         
    }


    /**
    * Checkout with Stripe.
    */
    public function process_checkout(Request $request)
    {    
        if(Cart::count()<1){ return "empty"; }
        if($request->ajax()) {
            $order = $request->all();
            // echo "<pre>"; print_r($order); exit;
            $currency = "gbp";    
            $amount_single = 0;
            $amount_monthly = 0;
            
            foreach(Cart::content() as $row) :
                if(strtoupper($row->options->interval) == "MONTHLY"){
                    $amount_monthly += $row->price;
                }
                else{ 
                    $amount_single += $row->price;
                }                 
            endforeach;

            //Do not Format a number with grouped thousands
            $amount_single = str_replace(",","", $amount_single);
            $amount_single = number_format((float)$amount_single, 2, '.', '');   
            $amount_single = $amount_single*100;  

            $amount_monthly = str_replace(",","", $amount_monthly);
            $amount_monthly = number_format((float)$amount_monthly, 2, '.', ''); 
            $amount_monthly = $amount_monthly*100;         

            $customer_email = $order['email'];
            $result_oneoff['status']  = NULL;
            $result_monthly['status']  = NULL; 
            $oneoff_success = "no";
            $monthly_success = "no";
            
            if($amount_single>0 && $amount_monthly == 0){
                $result_oneoff = $this->create_oneoff_payment($currency,$amount_single,$order);
                if(isset($result_oneoff['status'])){
                    $oneoff_success = $result_oneoff['status'];
                }
                
                if($oneoff_success == 'succeeded'){
                   $result_oneoff = $this->create_oneoff_payment2($currency,$amount_single,$order);
                } 
            }

            if($amount_monthly>0 && $amount_single == 0){
                $plan_id = $this->create_plan($currency,$amount_monthly);
                $customer_id = $this->create_customer($customer_email,$order);
                $result_monthly = $this->create_subscription($customer_id,$plan_id,$order); 

            }      

            if($amount_single>0 && $amount_monthly>0){
                $result_oneoff = $this->create_oneoff_payment($currency,$amount_single,$order);               
                if(isset($result_oneoff['status'])){
                    $oneoff_success = $result_oneoff['status'];
                }
                
                if($oneoff_success == 'succeeded'){
                    $plan_id = $this->create_plan($currency,$amount_monthly);
                    $customer_id = $this->create_customer($customer_email,$order);
                    $result_monthly = $this->create_subscription($customer_id,$plan_id,$order);
                }
            }  

            $amount_single = $amount_single/100;
            $amount_monthly = $amount_monthly/100;
            
            if(isset($result_oneoff['status'])){                
                if($result_oneoff['status'] != 'succeeded'){
                    $amount_single = 0;
                }
            }

            if(isset($result_monthly['status'])){
                if($result_monthly['status'] != 'active'){
                    $amount_monthly = 0;
                }
            }

            //Format a number with grouped thousands
            $amount_total = $amount_single + $amount_monthly;
            $amount_total  = number_format((float)$amount_total , 2, '.', ',');

            if(isset($result_monthly['status'])){
                $monthly_success = $result_monthly['status'];
            }
                        
            $amount_data['amount_total'] = $amount_total;             
            Session::put('amountdata', $amount_data);
            
            if(isset($result_oneoff['status']) || isset($result_monthly['status'])) {
                if($result_oneoff['status']  == 'succeeded' || $result_monthly['status']  == 'active') {
                    
                    $this->successful_checkout_confirmation($currency,$amount_total,$monthly_success,$order);
                }
            } else {
                echo $result_oneoff['error']['message'];
            }
            //curl_close($ch);
        }

    }

     /*****Function after successful checkout starts********/

    public function successful_checkout_confirmation($currency, $amount_total, $monthly_success, $order=array()){ 

        $items = Cart::content();
        // echo "<pre>"; print_r($items); exit;
        //object to array
        $items = json_decode(json_encode($items), true);

        if($monthly_success != 'active'){
            foreach($items as $subKey => $subArray){               
                if(strtoupper($subArray['options']['interval']) == 'monthly'){
                     unset($items[$subKey]);
                }
            }
        }

        //array to object
        $items = json_decode(json_encode($items), FALSE);       

        $reference = "reference";

        if($order['giftaid']=="true"){
           $giftaid_check = "Yes"; 
        }
        if($order['giftaid']=="false"){
           $giftaid_check = "No"; 
        }                  

        $donor_info = array($order['usernameincard'], $order['address'], $order['city'], $order['state'], $order['postcode'], $order['country']);
        $donor_info = array_filter($donor_info);
        $donor_info = implode('<br>', $donor_info);               

        
        $now = new DateTime();
        $donor = new Donor;
        $donor->name = $order['usernameincard'];
        $donor->firstname = $order['firstname'];
        $donor->lastname = $order['lastname'];
        $donor->email = $order['email'];
        $donor->postcode = $order['postcode'];
        $donor->city = $order['city'];
        $donor->state = $order['state'];
        $donor->address = $order['address'];
        $donor->country = $order['country'];            
        $donor->giftaid = $order['giftaid'];
        // $donor->contact = $order['contact'];
        $donor->save();
        $LastInsertId = $donor->id;
        
        $i = 0;
        $interval = "";

        foreach($items as $row): 
            foreach ($row as $key => $value) {
                $donation_data[$i]['donor_id'] = $LastInsertId;
                if( $row->options->interval == 'single') $interval = "One-off";
                if( $row->options->interval == 'monthly') $interval = "Monthly";
                if($key == 'id') $donation_data[$i]['campaign_id'] = $value;
                if($key == 'name') $donation_data[$i]['donation_title'] = $value;
                if($key == 'price') $donation_data[$i]['amount'] = $value;
                $donation_data[$i]['quantity'] = $row->qty;
                $donation_data[$i]['type'] = $interval;
                $donation_data[$i]['currency'] = $currency;
                $donation_data[$i]['name'] = $order['usernameincard'];
                $donation_data[$i]['country'] = $order['country'];
                $donation_data[$i]['firstname'] = $order['firstname'];
                $donation_data[$i]['lastname'] = $order['lastname'];
                $donation_data[$i]['email'] = $order['email'];
                $donation_data[$i]['postcode'] = $order['postcode'];
                $donation_data[$i]['city'] = $order['city'];
                $donation_data[$i]['state'] = $order['state'];
                $donation_data[$i]['address'] = $order['address'];
                $donation_data[$i]['reference'] = $currency;
                $donation_data[$i]['giftaid'] = $order['giftaid'];
                // $donation_data[$i]['contact'] = $order['contact'];

                $donation_data[$i]['created_at'] =$now;
                $donation_data[$i]['updated_at'] = $now;

                $cart_data[$i]['name'] = $row->name;
                $cart_data[$i]['type'] = $row->options->interval;
                $cart_data[$i]['price'] = $row->price;
                $cart_data[$i]['quantity'] = $row->qty;           
                $cart_data[$i]['image'] = $row->options->image;

            }
        $i++;
        endforeach;

        Donation::insert($donation_data);
        Cart::destroy();
        echo "SUCCESS";
    }

    /**
    * Add to Cart for quick donate
    */
    public function quick_donate(Request $request)
    {   
        if($request->ajax()) {
            $data = $request->all();
            $quickrowID = '';
            foreach(Cart::content() as $row){
                if($row->id == $data['campaign_id']){
                    $quickrowID = $row->rowId;
                } 
            }
            if(empty($quickrowID)) {
                 Cart::add($data['campaign_id'], $data['donation_name'], 1, $data['quick_amount'], ['interval' => $data['interval'],'image' => $data['quickimage']]);
                
            } else {
                Cart::update($quickrowID, 
                ['name' => $data['donation_name'] ,'price' => $data['quick_amount'],'options' => ['interval' => $data['interval'],'image' => $data['quickimage']]]);
                
            }
        }
    }
   
}

/**********Stripe class starts*************************/

class Stripe {
    public $headers;
    public $url = 'https://api.stripe.com/v1/';
    public $fields = array();
    function __construct () {
        $this->headers = array('Authorization: Bearer sk_test_FXo0UsjEA1OUpYsFABwWZAPQ'); // STRIPE_API_KEY = your stripe api key
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

class Stripe2 {
    public $headers;
    public $url = 'https://api.stripe.com/v1/';
    public $fields = array();
    function __construct () {
        $this->headers = array('Authorization: Bearer sk_test_4Q32AGtDsYoG1ycnRAd3cfGi'); // STRIPE_API_KEY = your stripe api key
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
