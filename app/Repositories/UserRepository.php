<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Factories\UserFactory;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    private UserFactory $homePageFactory;

    /**
     * @param UserFactory $homePageFactory
     */
    public function __construct(UserFactory $homePageFactory)
    {
        $this->homePageFactory = $homePageFactory;
    }

    /**
     * @param int $userId
     * @return UserDTO
     */
    public function getUserParameters (int $userId): UserDTO
    {
        return $this->homePageFactory->makeDTOFromModelCollection(User::where('id', $userId)->get());
    }

    /**
     * @param string $email
     * @return object|null
     */
    public function searchEmail(string $email): object|null
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $userEmail
     * @param string|null $userAvatar
     * @param int|null $countryId
     * @param int|null $cityId
     * @return object
     */
    public function createUser(string|null $firstName, string|null $lastName, string|null $userEmail, string|null $userAvatar, int|null $countryId, int|null $cityId): object
    {
        return User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $userEmail,
            'google_avatar' => $userAvatar,
            'country_id' => $countryId,
            'city_id' => $cityId,
        ]);
    }
}
