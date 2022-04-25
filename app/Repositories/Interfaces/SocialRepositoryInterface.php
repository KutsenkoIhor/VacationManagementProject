<?php

namespace App\Repositories\Interfaces;


interface SocialRepositoryInterface
{
    public function searchEmail(string $email);
    public function createUser(string $firstName, string $lastName, string $userEmail, string $userAvatar);
}
