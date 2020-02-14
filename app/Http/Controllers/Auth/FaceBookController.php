<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Auth;

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
            return redirect('/about');
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
        }

        return $user;
    }
}