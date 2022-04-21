<?php

namespace App\Repositories;


use App\Models\User;
use App\Repositories\Interfaces\SocialRepositoryInterface;

class SocialRepository implements SocialRepositoryInterface
{
    public function searchEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function createUser($firstName, $lastName, $userEmail, $userAvatar)
    {
        return User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $userEmail,
                'google_avatar' => $userAvatar,
            ]);
    }
}


