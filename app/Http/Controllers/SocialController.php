<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\SocialRepositoryInterface;
use App\Repositories\Interfaces\DomainsRepositoryInterface;
use Illuminate\Console\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    private SocialRepositoryInterface $socialRepository;
    private DomainsRepositoryInterface $domainsRepository;

    public function __construct(SocialRepositoryInterface $socialRepository, DomainsRepositoryInterface $domainsRepository)
    {
        $this->socialRepository = $socialRepository;
        $this->domainsRepository = $domainsRepository;
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
        } elseif ($this->checkDomain($user)) {
            $createUser = $this->socialRepository->createUser(
                $user["given_name"],
                $user["family_name"],
                $user["email"],
                $user["picture"]);

            Auth::login($createUser);
        } else {
            return redirect(route('auth.error'));
        }

        return redirect(route('page.homePage'));
    }

    private function checkDomain(array $user): bool
    {
        $domains = $this->domainsRepository->all();
        $AllowedDomains = [];

        foreach($domains as $domain) {
            $AllowedDomains[] = $domain->name;
        }

        if (empty($AllowedDomains)) {
            return true;
        }

        list($nickname, $userDomain) = explode('@', $user["email"]);

        if (in_array($userDomain, $AllowedDomains)){
            return true;
        }

        return false;
    }
}
