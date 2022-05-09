<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\SocialRepositoryInterface;
use Illuminate\Console\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    private SocialRepositoryInterface $socialRepository;

    public function __construct(SocialRepositoryInterface $socialRepository)
    {
        $this->socialRepository = $socialRepository;
    }

    public function googleRedirect(): Redirector|RedirectResponse|Application
    {
        return Auth::check() ? redirect(route('page.homePage')) : Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle(): Redirector|RedirectResponse|Application
    {
        if (Auth::check()) {
            return redirect(route('page.homePage'));
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
        return redirect(route('page.homePage'));
    }
}
