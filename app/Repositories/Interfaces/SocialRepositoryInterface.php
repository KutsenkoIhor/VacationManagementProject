<?php

namespace App\Repositories\Interfaces;


interface SocialRepositoryInterface
{
    public function searchEmail($email);
    public function createUser($firstName, $lastName, $userEmail, $userAvatar);
}
