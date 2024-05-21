<?php

namespace App\Http\Controllers\Auth\Socialite;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /*******************************************************************/
    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($socialUser,$provider);
        Auth::login($authUser,true);

        return redirect()->route('home');
    }
    /*******************************************************************/

    public function findOrCreateUser($user , $provider)
    {
        $authUser = User::where('provider_id',$user->id)->first();
        if($user->password)
        {
            $hashedPassword = Hash::make($user->password);
        }

        if($authUser)
        {
            return $authUser;
        }
        return User::create([
            'provider_id' => $user->id,
            'provider' => $provider,
            'name' => $user->name ?? '',
            'email' => $user->email ?? '',
            'provider_token' => $user->token ?? '',
            'password'=>$hashedPassword ?? null,

            ]);
    }

}
