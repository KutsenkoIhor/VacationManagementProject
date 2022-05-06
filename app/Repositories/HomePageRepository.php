<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Factories\HomePageFactory;
use App\Models\User;
use App\Repositories\Interfaces\HomePageRepositoryInterface;

class HomePageRepository implements HomePageRepositoryInterface
{
    private HomePageFactory $homePageFactory;

    /**
     * @param HomePageFactory $homePageFactory
     */
    public function __construct(HomePageFactory $homePageFactory)
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

}
