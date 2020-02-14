<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Auth;
use App\Customer;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        error_log("Here is one");
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $userInfo = Socialite::driver('google')->stateless()->user();

            $createdUser = $this->userFindorCreate( $userInfo );
            Auth::loginUsingId($createdUser->id);
            return redirect('/dashboard');
        } catch (Exception $e) {
            error_log("Error: AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA");
            error_log($e);
            return redirect('/login');
        }
    }

    public function userFindorCreate( $google_user ) {
        error_log($google_user->email);
        $user = User::where('email', $google_user->email)->first();

        if(!$user) {
            $user = User::create([
                'name' => $google_user->name,
                'email' => $google_user->email,
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
    
            $sender_name =  $google_user->name;
            $sender_email = $google_user->email;
    
            Mail::send('emails.registration', array('data'=>$google_user), function ($message) use ($sender_name, $sender_email) {
                $message->from('hello@runningmad.co.uk', 'Runningmad');
                $message->subject('Welcome to Runningmad');
                $message->to($sender_email);
            });
        }

        return $user;
    }
}