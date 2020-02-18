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
Use App\Donation;
Use Cart as Cart;
use Mail;
use Session;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use URL;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        error_log("Loggggg");
        $countries = array('United Kingdom' =>'United Kingdom' ,'Afganistan' =>'Afganistan','Albania' =>'Albania','Algeria' =>'Algeria','American Samoa' =>'American Samoa','Andorra' =>'Andorra','Angola' =>'Angola' ,'Anguilla' =>'Anguilla','Antigua & Barbuda' =>'Antigua & Barbuda','Argentina' =>'Argentina','Armenia' =>'Armenia','Aruba' =>'Aruba','Australia' =>'Australia','Austria' =>'Austria' ,'Azerbaijan' =>'Azerbaijan','Bahamas' =>'Bahamas','Bahrain' =>'Bahrain','Bangladesh' =>'Bangladesh','Barbados' =>'Barbados','Belarus' =>'Belarus','Belgium' =>'Belgium','Belize' =>'Belize' ,'Benin' =>'Benin','Bermuda' =>'Bermuda','Bhutan' =>'Bhutan','Bolivia' =>'Bolivia','Bonaire' =>'Bonaire','Bosnia & Herzegovina' =>'Bosnia & Herzegovina','Botswana' =>'Botswana','Brazil' =>'Brazil' ,'British Indian Ocean Ter' =>'British Indian Ocean Ter','Brunei' =>'Brunei','Bulgaria' =>'Bulgaria','Burkina Faso' =>'Burkina Faso','Burundi' =>'Burundi','Cambodia' =>'Cambodia','Cameroon' =>'Cameroon' ,'Canada' =>'Canada','Canary Islands' =>'Canary Islands','Cape Verde' =>'Cape Verde','Cayman Islands' =>'Cayman Islands','Central African Republic' =>'Central African Republic','Chad' =>'Chad' ,'Channel Islands' =>'Channel Islands','Chile' =>'Chile','China' =>'China','Christmas Island' =>'Christmas Island','Cocos Island' =>'Cocos Island','Colombia' =>'Colombia','Comoros' =>'Comoros','Congo' =>'Congo' ,'Cook Islands' =>'Cook Islands','Costa Rica' =>'Costa Rica','Croatia' =>'Croatia','Cuba' =>'Cuba','Curacao' =>'Curacao','Cyprus' =>'Cyprus','Czech Republic' =>'Czech Republic' ,'Denmark' =>'Denmark','Djibouti' =>'Djibouti','Dominica' =>'Dominica','Dominican Republic' =>'Dominican Republic','East Timor' =>'East Timor','Ecuador' =>'Ecuador','Egypt' =>'Egypt','El Salvador' =>'El Salvador' ,'Equatorial Guinea' =>'Equatorial Guinea','Eritrea' =>'Eritrea','Estonia' =>'Estonia','Ethiopia' =>'Ethiopia','Falkland Islands' =>'Falkland Islands','Faroe Islands' =>'Faroe Islands','Fiji' =>'Fiji' ,'Finland' =>'Finland','France' =>'France','French Guiana' =>'French Guiana','French Polynesia' =>'French Polynesia','French Southern Ter' =>'French Southern Ter','Gabon' =>'Gabon','Gambia' =>'Gambia','Georgia' =>'Georgia' ,'Germany' =>'Germany','Ghana' =>'Ghana','Gibraltar' =>'Gibraltar','Great Britain' =>'Great Britain','Greece' =>'Greece','Greenland' =>'Greenland','Grenada' =>'Grenada','Guadeloupe' =>'Guadeloupe','Guam' =>'Guam' ,'Guatemala' =>'Guatemala','Guinea' =>'Guinea','Guyana' =>'Guyana','Haiti' =>'Haiti','Hawaii' =>'Hawaii','Honduras' =>'Honduras','Hong Kong' =>'Hong Kong','Hungary' =>'Hungary','Iceland' =>'Iceland','India' =>'India' ,'Indonesia' =>'Indonesia','Iran' =>'Iran','Iraq' =>'Iraq','Ireland' =>'Ireland','Isle of Man' =>'Isle of Man','Israel' =>'Israel','Italy' =>'Italy','Jamaica' =>'Jamaica','Japan' =>'Japan','Jordan' =>'Jordan' ,'Kazakhstan' =>'Kazakhstan','Kenya' =>'Kenya','Kiribati' =>'Kiribati','Korea North' =>'Korea North','Korea South' =>'Korea South','Kuwait' =>'Kuwait','Kyrgyzstan' =>'Kyrgyzstan','Laos' =>'Laos','Latvia' =>'Latvia' ,'Lebanon' =>'Lebanon','Lesotho' =>'Lesotho','Liberia' =>'Liberia','Libya' =>'Libya','Liechtenstein' =>'Liechtenstein','Lithuania' =>'Lithuania','Luxembourg' =>'Luxembourg','Macau' =>'Macau','Macedonia' =>'Macedonia' ,'Madagascar' =>'Madagascar','Malaysia' =>'Malaysia','Malawi' =>'Malawi','Maldives' =>'Maldives','Mali' =>'Mali','Malta' =>'Malta','Marshall Islands' =>'Marshall Islands','Martinique' =>'Martinique','Mauritania' =>'Mauritania' ,'Mauritius' =>'Mauritius','Mayotte' =>'Mayotte','Mexico' =>'Mexico','Midway Islands' =>'Midway Islands','Moldova' =>'Moldova','Monaco' =>'Monaco','Mongolia' =>'Mongolia','Montserrat' =>'Montserrat','Morocco' =>'Morocco' ,'Mozambique' =>'Mozambique','Myanmar' =>'Myanmar','Nambia' =>'Nambia','Nauru' =>'Nauru','Nepal' =>'Nepal','Netherland Antilles' =>'Netherland Antilles','Netherland' =>'Netherlands (Holland, Europe)','Nevis' =>'Nevis' ,'New Caledonia' =>'New Caledonia','New Zealand' =>'New Zealand','Nicaragua' =>'Nicaragua','Niger' =>'Niger','Nigeria' =>'Nigeria','Niue' =>'Niue','Norfolk Island' =>'Norfolk Island','Norway' =>'Norway','Oman' =>'Oman' ,'Pakistan' =>'Pakistan','Palau Island' =>'Palau Island','Palestine' =>'Palestine','Panama' =>'Panama','Papua New Guinea' =>'Papua New Guinea','Paraguay' =>'Paraguay','Peru' =>'Peru','Philippines' =>'Philippines' ,'Pitcairn Island' =>'Pitcairn Island','Poland' =>'Poland','Portugal' =>'Portugal','Puerto Rico' =>'Puerto Rico','Qatar' =>'Qatar','Republic of Montenegro' =>'Republic of Montenegro','Republic of Serbia' =>'Republic of Serbia' ,'Reunion' =>'Reunion','Romania' =>'Romania','Russia' =>'Russia','Rwanda' =>'Rwanda','St Barthelemy' =>'St Barthelemy','St Eustatius' =>'St Eustatius','St Helena' =>'St Helena','St Kitts-Nevis' =>'St Kitts-Nevis' ,'St Lucia' =>'St Lucia','St Maarten' =>'St Maarten','St Pierre & Miquelon' =>'St Pierre & Miquelon','St Vincent & Grenadines' =>'St Vincent & Grenadines','Saipan' =>'Saipan','Samoa' =>'Samoa' ,'Samoa American' =>'Samoa American','San Marino' =>'San Marino','Sao Tome & Principe' =>'Sao Tome & Principe','Saudi Arabia' =>'Saudi Arabia','Senegal' =>'Senegal','Serbia' =>'Serbia','Seychelles' =>'Seychelles' ,'Sierra Leone' =>'Sierra Leone','Singapore' =>'Singapore','Slovakia' =>'Slovakia','Slovenia' =>'Slovenia','Solomon Islands' =>'Solomon Islands','Somalia' =>'Somalia','South Africa' =>'South Africa','Spain' =>'Spain' ,'Sri Lanka' =>'Sri Lanka','Sudan' =>'Sudan','Suriname' =>'Suriname','Swaziland' =>'Swaziland','Sweden' =>'Sweden','Switzerland' =>'Switzerland','Syria' =>'Syria','Tahiti' =>'Tahiti','Taiwan' =>'Taiwan' ,'Tajikistan' =>'Tajikistan','Tanzania' =>'Tanzania','Thailand' =>'Thailand','Togo' =>'Togo','Tokelau' =>'Tokelau','Tonga' =>'Tonga','Trinidad & Tobago' =>'Trinidad & Tobago','Tunisia' =>'Tunisia','Turkey' =>'Turkey' ,'Turkmenistan' =>'Turkmenistan','Turks & Caicos Is' =>'Turks & Caicos Is','Tuvalu' =>'Tuvalu','Uganda' =>'Uganda','Ukraine' =>'Ukraine','United Arab Emirates' =>'United Arab Emirates','United States of America' =>'United States of America' ,'Uruguay' =>'Uruguay','Uzbekistan' =>'Uzbekistan','Vanuatu' =>'Vanuatu','Vatican City State' =>'Vatican City State','Venezuela' =>'Venezuela','Vietnam' =>'Vietnam','irgin Islands (Brit)' =>'irgin Islands (Brit)','Virgin Islands (USA)' =>'Virgin Islands (USA)' ,'Wake Island' =>'Wake Island','Wallis & Futana Is' =>'Wallis & Futana Is','Yemen' =>'Yemen','Zaire' =>'Zaire','Zambia' =>'Zambia','Zimbabwe' =>'Zimbabwe');

        $userId = Auth::id();
        $orders = User::find($userId)->orders;
        $delivery_address = Customer::where('user_id', $userId)->firstOrFail();
        
        return view('dashboard')->with(array('orders'=> $orders, 'delivery_address' => $delivery_address, 'countries' => $countries ));
    }

    /**
    * Loading single order
    */
    public function show($orderId)
    { 
        $order = Order::where('id', '=', $orderId)->where('user_id', '=', Auth::id())->firstOrFail();

        return view('order', compact('order'));
    }

    /**
    * Update profile
    */
    public function update_profile(Request $request)
    {
        if($request->ajax()) {
            $user = Auth::user(); 
            $data = $request->all();
            if(empty($data['password'])){
                $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email'
                ]);

                if ($validator->passes()) {
                    User::where('id', $user->id)->update(['name' => $data['name'],'email' => $data['email']]); 
                    error_log($data['address']);
                    Customer::where('user_id', $user->id)->update([ 'address' => $data['address'], 'city' => $data['city'],'postcode' => $data['postalcode'],'country' => $data['country'],'phone' => $data['phone']]);
                }
                return response()->json(['error'=>$validator->errors()->all()]);
            } else {
                error_log("Here is password");
                $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:6'
                ]);
                if ($validator->passes()) {
                    error_log("Pass the validation");
                    User::where('id', $user->id)->update(['name' => $data['name'],'email' => $data['email'], 'password' => bcrypt($data['password'])]); 
                    Customer::where('user_id', $user->id)->update([ 'address' => $data['address'], 'city' => $data['city'],'postcode' => $data['postalcode'],'country' => $data['country'],'phone' => $data['phone']]);
                }
                return response()->json(['error'=>$validator->errors()->all()]);
            }
        }
    }


    /**
    * Uploading evidence
    */
    public function evidenceprocess(Request $request)
    { 
        if($request->ajax()) {
            $validation = Validator::make($request->all(), [
            'filenames.*' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:2048'
            ]);
            
            if($validation->passes()) {
                $images = array();
                $data = $request->all();
                $tobeuploadedimages = explode(",",$data['imglists']);
                $orderId = $data['order_id'];
                $orderEmail = $data['order_email'];
                if($request->hasfile('files')) {
                    foreach($request->file('files')  as $file)
                    {
                        $fileoriginalName =  $file->getClientOriginalName();
                        if (in_array($fileoriginalName, $tobeuploadedimages)){
                            $new_name = rand() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('evidence'), $new_name);
                            $images[] = $new_name;  
                        }
                    }
                 }

                // update file name to the database
                if($images){ 
                    $existingevidence = Order::select('evidence')->where('id',$orderId)->first();
                    if(count($existingevidence->evidence) > 0) {
                        $updated_evidence_data = json_encode(array_merge(json_decode($existingevidence->evidence, true),json_decode(json_encode($images), true)));
                        $evidenceUpdated = Order::where('id',$orderId)->update(['evidence' =>$updated_evidence_data, 'status' => 'Evidence Submitted']);
                    } else {
                        $evidenceUpdated = Order::where('id',$orderId)->update(['evidence' =>json_encode($images), 'status' => 'Evidence Submitted']);
                    }
                    $this->send_email($orderId,$orderEmail);
                } else { 
                    return response()->json([
                    'message'   => "Please select file",
                    'class_name'  => 'alert-danger'
                    ]);
                }

                if( !$evidenceUpdated) {
                    return response()->json([
                    'message'   => "Something went wrong to upload",
                    'class_name'  => 'alert-danger'
                    ]);
                }

                return response()->json([
                 'message'   => 'File Uploaded Successfully',
                 'class_name'  => 'alert-success'
                ]);

            } else {
                return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
                ]);
            }
        }
    }


    /**
    * Sending email
    */
    public function send_email($orderid, $orderemail )
    {
        $user = Auth::user();
        $sender_name =  $user->name;
        $order_id =  $orderid;
        $order_email =  $orderemail;

        Mail::send('emails.userevidencesubmissionconfirmation', array('orderid'=>$orderid ), function ($message) use ($order_id, $order_email) {
            $message->from('hello@runningmad.co.uk', 'Runningmad');
            $message->subject('Thank you for submitting evidence');
            $message->to($order_email);
        });

        Mail::send('emails.adminevidencesubmissionnotification', array('orderid'=>$orderid ), function ($message) use ($order_email,$sender_name) {
            $message->from($order_email, $sender_name);
            $message->subject('New evidence submission');
            $message->to('hello@runningmad.co.uk');
        });
    }

}



