<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\UsersDTO;
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
     * @return UsersDTO
     */
    public function getUserParameters (int $userId): UsersDTO
    {
        return $this->homePageFactory->makeDTOFromModelCollection(User::where('id', $userId)->get());
    }

}
