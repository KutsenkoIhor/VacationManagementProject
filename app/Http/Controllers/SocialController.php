<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $isUser = User::where('email', $user->email)->first();
        if ($isUser) {
            Auth::login($isUser);
            print_r("getAvatar - ");
            print_r($user->getAvatar());
            print_r("<br>");
            print_r("getName - ");
            print_r($user->getName());
            print_r("<br>");
            print_r("getNickname - ");
            print_r($user->getNickname());
        } else {
            $createUser = User::create([
                'first_name' => $user->name,
                'email' => $user->email,
                'google_avatar' => $user->avatar,
            ]);
            Auth::login($createUser);
            print_r("wery good");
        }
    }
}
