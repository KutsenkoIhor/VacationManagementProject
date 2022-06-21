<?php

namespace App\Handlers;

use App\Factories\EmployeePmFactory;
use App\Factories\UserFactory;
use App\Repositories\EmployeesAndPmRepository;
use App\Repositories\UserRepository;

class HRManagementHandler
{
    private UserRepository $userRepository;
    private UserFactory $userFactory;


    public function __construct(
        UserRepository $userRepository,
        UserFactory $userFactory,

    )
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public function getUserName(string $firstName, string $lastName): string
    {
        $fName = $this->mb_ucfirst(mb_strtolower($firstName));
        $lName = $this->mb_ucfirst(mb_strtolower($lastName));
        return $lName . " " . $fName;
    }

    /**
     * @param string $string
     * @return string
     */
    private function mb_ucfirst(string $string): string
    {
        return mb_strtoupper(mb_substr($string, 0, 1)).mb_substr($string, 1);
    }

    public function getArrUserIdWithRole(): array
    {
        $arrUserId = [];
        $collectionUsers = $this->userRepository->all();
        foreach ($collectionUsers as $userModel) {
            if ($userModel->hasRole('HR')) {
                $dataUser = $this->userFactory->makeDTOFromModel($userModel);
                $arrUserId[] = $dataUser->getId();
            }
        }
        return $arrUserId;
    }

}
