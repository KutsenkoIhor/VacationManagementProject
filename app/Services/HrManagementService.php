<?php

namespace App\Services;

use App\Factories\UserFactory;
use App\Handlers\HRManagementHandler;
use App\Repositories\UserRepository;

class HrManagementService
{
    private UserRepository $userRepository;
    private UserFactory $userFactory;
    private HrManagementHandler $hrManagementHandler;

    public function __construct(
        UserRepository $userRepository,
        UserFactory $userFactory,
        HrManagementHandler $hrManagementHandler,

    )
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
        $this->hrManagementHandler = $hrManagementHandler;

    }

    public function getCollectionPm($request): object
    {
        $arrIdUsers = json_decode($request->get('userId'));
        if ($arrIdUsers !== []) {
            $collectionUsers = $this->userRepository->getUserModelsWhereIdInArrHr($arrIdUsers);
        } else {
            $arrIdUsersPM = $this->hrManagementHandler->getArrUserIdWithRole();
            $collectionUsers = $this->userRepository->getUserModelsWhereIdInArrHr($arrIdUsersPM);
        }
        return $collectionUsers;
    }

    public function getDataForElasticsearch(): array
    {
        $userInformation = [];
        $collectionUsers = $this->userRepository->all();
        foreach ($collectionUsers as $userModel) {
            if ($userModel->hasRole('HR')) {
                $dataUser = $this->userFactory->makeDTOFromModel($userModel);
                $userID = $dataUser->getId();
                $fullName = $this->hrManagementHandler->getUserName($dataUser->getFirstName(), $dataUser->getLastName());
                $userInformation[$userID]['email'] = $dataUser->getEmail();
                $userInformation[$userID]['name'] = $fullName;
            }
        }
        return $userInformation;
    }

    public function getArrDataForPagination($collectionUsers): array
    {
        $dataForPagination = [];
        $arrCollectionUsers = $collectionUsers->toArray();
        $dataForPagination['current_page'] = $arrCollectionUsers["current_page"];
        $dataForPagination['last_page'] = $arrCollectionUsers["last_page"];
        return $dataForPagination;
    }

    public function getArrDataHrInformation($collectionUsers): array
    {
        $dataHrInformation = [];
        foreach ($collectionUsers as $userModel) {
            $dataUser = $this->userFactory->makeDTOFromModel($userModel);
            $userID = $dataUser->getId();
            $fullName = $this->hrManagementHandler->getUserName($dataUser->getFirstName(), $dataUser->getLastName());
            $dataHrInformation[$userID]['email'] = $dataUser->getEmail();
            $dataHrInformation[$userID]['name'] = $fullName;
            $dataHrInformation[$userID]['googleAvatar'] = $dataUser->getGoogleAvatar();
        }
        return $dataHrInformation;
    }

    public function getListLocationHr(int $idHr): array
    {
        $teamInformation = [];
        $pmModel = $this->userRepository->getUserModelById($idHr);
        $hrDto = $this->userFactory->makeDTOFromModel($pmModel);
        $teamInformation['hr']['email'] = $hrDto->getEmail();
        $fullName = $this->hrManagementHandler->getUserName($hrDto->getFirstName(), $hrDto->getLastName());
        $teamInformation['hr']['name'] = $fullName;
        $teamInformation['hr']['avatar'] = $hrDto->getGoogleAvatar();

//        $teamInformation['team'] = null;
//        $arrIdTeam = $this->pmManagementHandler->getArrIdTeam($idPm);
//        foreach ($arrIdTeam as $employeeId) {
//            $employeeModel = $this->userRepository->getUserModelById($employeeId);
//            $employeeDto = $this->userFactory->makeDTOFromModel($employeeModel);
//            $fullNameEmployee = $this->pmManagementHandler->getUserName($employeeDto->getFirstName(), $employeeDto->getLastName());
//            $teamInformation['team'][$employeeId]['name'] = $fullNameEmployee;
//            $teamInformation['team'][$employeeId]['email'] = $employeeDto->getEmail();
//            $teamInformation['team'][$employeeId]['avatar'] = $employeeDto->getGoogleAvatar();
//            $teamInformation['team'][$employeeId]['country'] = $employeeDto->getCountryId() ? $this->countriesRepository->searchCountryById($employeeDto->getCountryId()) : null;
//        }
        return $teamInformation;
    }

}
