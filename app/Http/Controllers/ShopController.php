<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use DateTime;
Use Auth;
use Storage;
Use App\Race;
Use App\Racer;
Use App\Order;
Use App\Donor;
Use App\Customer;
Use App\Product;
Use App\Donation;
Use Cart as Cart;
use Session;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use URL;


class ShopController extends Controller
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
        $products = Product::where('status', '=', 'PUBLISHED')->get();
        return view('shop')->with(array('products'=> $products ));
    }

    /**
    * Loading single order
    */
    public function show()
    { 
        $product = Product::where('status', '=', 'PUBLISHED')->firstOrFail();
        return view('shop-single')->with(array('product'=> $product ));
    }

  
}



