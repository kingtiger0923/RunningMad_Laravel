<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Mail;
use DB;
use DateTime;
use Input;
Use Auth;
use Storage;
Use App\Campaign;
Use App\Category;
Use App\Post;
Use App\Page;
Use App\Coupon;
Use App\Contact;
Use Cart as Cart;
Use App\Customer;


class PageController extends Controller
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
        $data = page::all();
        $allcampaigns = DB::table('campaigns')->where('status', "PUBLISHED")->get();
        return view('page')->with(array('data'=> $data, 'allcampaigns'=> $allcampaigns));
    }

    /**
     * Load Single Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {   
        $campaigns = DB::table('campaigns')->where('status', "PUBLISHED")->get();
        $page = Page::where('slug', '=', $slug)->firstOrFail();
         return view('page')->with(array('page'=> $page, 'data'=> $campaigns, 'allcampaigns'=> $campaigns ));
    }

    /**
     * Checkout Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {   
        if(Auth::guest()){ //new user
            return view('checkout');
        } else {
            $user = Auth::user();
            // retrieved address of loggedin user
            $billing_address = Customer::where('user_id', $user->id)->get();
            return view('checkout')->with(array('billing_address' =>$billing_address ));
        }
    }

    /**
     * About Us Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {   
        return view('about');
    }

    /**
     * Contact Us Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {   
        $campaigns = DB::table('campaigns')->where('status', "PUBLISHED")->get();
        return view('contact')->with(array('allcampaigns'=> $campaigns ));
    }

    /**
     * Service Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function services()
    {   
        $services = Service::all();
        $campaigns = DB::table('campaigns')->where('status', "PUBLISHED")->get();
        return view('services')->with(array('data'=> $services, 'allcampaigns'=> $campaigns  ));
    }


    /**
     * Save contact data from contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function processcontact(Request $request)
    {   

        if($request->ajax()) {
            $contact_info = $request->all();           
            $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            ]);
            if ($validator->passes()) {
                Contact::create($request->all());
                $data = [
                    'firstname'     => $contact_info['firstname'],
                    'lastname'     => $contact_info['lastname'],
                    'email'     => $contact_info['email'],
                    'content'     => $contact_info['message'],
                    'phone'     => $contact_info['phone'],
                ];

                $sender_name = $contact_info['firstname']." ".$contact_info['lastname'];
                 $sender_email = $contact_info['email'];

                // sending email to admin with contact form information
                Mail::send('emails.contactadminnotification', $data, function ($message) use ($sender_name, $sender_email) {
                    $message->from($sender_email, $sender_name);
                    $message->subject('New contact submission');
                    $message->to('hello@runningmad.co.uk');
                }); 

                return response()->json(['success'=>'Success']);
            }

            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }
}
