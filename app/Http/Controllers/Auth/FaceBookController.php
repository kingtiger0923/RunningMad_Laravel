<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Auth;
use App\Customer;

class FaceBookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFaceBook()
    {
        error_log("Here is one");
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFaceBookCallback()
    {
        try {
            $userInfo = Socialite::driver('facebook')->stateless()->user();
            
            $createdUser = $this->userFindorCreate( $userInfo );
            Auth::loginUsingId($createdUser->id);
            return redirect('/dashboard');
        } catch (Exception $e) {
            error_log("Error: AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA");
            error_log($e);
            return redirect('/login');
        }
    }

    public function userFindorCreate( $facebook_user ) {
        error_log($facebook_user->email);
        $user = User::where('email', $facebook_user->email)->first();

        if(!$user) {
            $user = User::create([
                'name' => $facebook_user->name,
                'email' => $facebook_user->email,
                'password' => bcrypt('123456'),
            ]);

            Customer::create([
                'user_id' => $user->id,
                'address' => "none",
                'city' => "none",
                'postcode' => "none",
                'country' => "none",
                'phone' => "none",
            ]);
    
            $sender_name =  $facebook_user->name;
            $sender_email = $facebook_user->email;
    
            Mail::send('emails.registration', array('data'=>$facebook_user), function ($message) use ($sender_name, $sender_email) {
                $message->from('hello@runningmad.co.uk', 'Runningmad');
                $message->subject('Welcome to Runningmad');
                $message->to($sender_email);
            });
        }

        return $user;
    }
}