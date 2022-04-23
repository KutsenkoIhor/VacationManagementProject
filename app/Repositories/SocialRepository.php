<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\SocialRepositoryInterface;

class SocialRepository implements SocialRepositoryInterface
{

    /**
     * @param string $email
     * @return object|null
     */
    public function searchEmail(string $email): object|null
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $userEmail
     * @param string $userAvatar
     * @return object
     */
    public function createUser(string $firstName, string $lastName, string $userEmail, string $userAvatar): object
    {
        return User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $userEmail,
                'google_avatar' => $userAvatar,
            ]);
    }
}


