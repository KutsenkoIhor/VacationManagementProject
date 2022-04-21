<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\SocialRepositoryInterface;
use App\Repositories\SocialRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    private SocialRepository $socialRepository;

    public function __construct(SocialRepositoryInterface $socialRepository)
    {
        $this->socialRepository = $socialRepository;
    }

    public function googleRedirect()
    {
        return Auth::check() ? redirect(route('test')) : Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle()
    {
        if (Auth::check()) {
            return redirect(route('test'));
        }
        $user = Socialite::driver('google')->stateless()->user()->user;
        $isUser = $this->socialRepository->searchEmail($user["email"]);
        if ($isUser) {
            Auth::login($isUser);
        } else {
            $createUser = $this->socialRepository->createUser(
                $user["given_name"],
                $user["family_name"],
                $user["email"],
                $user["picture"]);
            Auth::login($createUser);
        }
        return redirect(route('test'));
    }
}
