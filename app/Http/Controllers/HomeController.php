<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use DateTime;
use Input;
Use Auth;
use Storage;
Use App\Race;
Use Cart as Cart;


class HomeController extends Controller
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
    public function index()
    {
        $races = DB::table('races')->where('status', "PUBLISHED")->where('is_featured', "yes")->get();
        $races = Race::where('status', '=', "PUBLISHED")
        ->where('is_featured', "yes")
        ->orderBy('created_at', 'desc')
        ->get();
        return view('home')->with(array('races'=> $races));
    }
}
