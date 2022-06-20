<?php

namespace App\Services;

use App\Factories\UserFactory;
use App\Handlers\PmManagementHandler;
use App\Repositories\CountriesRepository;
use App\Repositories\EmployeesAndPmRepository;
use App\Repositories\UserRepository;
use Exception;

class PmManagementService
{
    private UserRepository $userRepository;
    private CountriesRepository $countriesRepository;
    private EmployeesAndPmRepository $employeesAndPmRepository;
    private UserFactory $userFactory;
    private PmManagementHandler $pmManagementHandler;

    public function __construct(
        UserRepository $userRepository,
        CountriesRepository $countriesRepository,
        EmployeesAndPmRepository $employeesAndPmRepository,
        UserFactory $userFactory,
        PmManagementHandler $pmManagementHandler,

    )
    {
        $this->userRepository = $userRepository;
        $this->employeesAndPmRepository = $employeesAndPmRepository;
        $this->userFactory = $userFactory;
        $this->pmManagementHandler = $pmManagementHandler;
        $this->countriesRepository = $countriesRepository;
    }

    /**
     * @param $request
     * @return object
     */
    public function getCollectionPm($request): object
    {
        $arrIdUsers = json_decode($request->get('userId'));
        if ($arrIdUsers !== []) {
            $collectionUsers = $this->userRepository->getUserModelsWhereIdInArr($arrIdUsers);
        } else {
            $arrIdUsersPM = $this->pmManagementHandler->getArrUserIdWithRole();
            $collectionUsers = $this->userRepository->getUserModelsWhereIdInArr($arrIdUsersPM);
        }
        return $collectionUsers;
    }

    /**
     * @return array
     */
    public function getDataForElasticsearch(): array
    {
        $userInformation = [];
        $collectionUsers = $this->userRepository->all();
        foreach ($collectionUsers as $userModel) {
            if ($userModel->hasRole('PM')) {
                $dataUser = $this->userFactory->makeDTOFromModel($userModel);
                $userID = $dataUser->getId();
                $fullName = $this->pmManagementHandler->getUserName($dataUser->getFirstName(), $dataUser->getLastName());
                $userInformation[$userID]['email'] = $dataUser->getEmail();
                $userInformation[$userID]['name'] = $fullName;
            }
        }
        return $userInformation;
    }

    /**
     * @param $collectionUsers
     * @return array
     */
    public function getArrDataForPagination($collectionUsers): array
    {
        $dataForPagination = [];
        $arrCollectionUsers = $collectionUsers->toArray();
        $dataForPagination['current_page'] = $arrCollectionUsers["current_page"];
        $dataForPagination['last_page'] = $arrCollectionUsers["last_page"];
        return $dataForPagination;
    }

    /**
     * @param $collectionUsers
     * @return array
     */
    public function getArrDataPmInformation($collectionUsers): array
    {
        $dataPmInformation = [];
        $arrIdPmWithTeam = $this->pmManagementHandler->getIdPmAndIdEmployee();
        foreach ($collectionUsers as $userModel) {
            $dataUser = $this->userFactory->makeDTOFromModel($userModel);
            $userID = $dataUser->getId();
            $fullName = $this->pmManagementHandler->getUserName($dataUser->getFirstName(), $dataUser->getLastName());
            $dataPmInformation[$userID]['email'] = $dataUser->getEmail();
            $dataPmInformation[$userID]['name'] = $fullName;
            $dataPmInformation[$userID]['googleAvatar'] = $dataUser->getGoogleAvatar();

            if (array_key_exists($userID, $arrIdPmWithTeam)) {
                $dataPmInformation[$userID]['numberOfPersons'] = count($arrIdPmWithTeam[$userID]);
                $dataPmInformation[$userID]['teamAvatar'] = $this->pmManagementHandler->teamInformation($arrIdPmWithTeam[$userID]);
            } else {
                $dataPmInformation[$userID]['numberOfPersons'] = null;
                $dataPmInformation[$userID]['teamAvatar'] = null;
            }
        }
        return $dataPmInformation;
    }

    /**
     * @param int $idPm
     * @return array
     */
    public function getTeamInformation(int $idPm): array
    {
        $teamInformation = [];
        $pmModel = $this->userRepository->getUserModelById($idPm);
        $pmDto = $this->userFactory->makeDTOFromModel($pmModel);
        $teamInformation['pm']['email'] = $pmDto->getEmail();
        $fullName = $this->pmManagementHandler->getUserName($pmDto->getFirstName(), $pmDto->getLastName());
        $teamInformation['pm']['name'] = $fullName;
        $teamInformation['pm']['avatar'] = $pmDto->getGoogleAvatar();

        $teamInformation['team'] = null;
        $arrIdTeam = $this->pmManagementHandler->getArrIdTeam($idPm);
        foreach ($arrIdTeam as $employeeId) {
            $employeeModel = $this->userRepository->getUserModelById($employeeId);
            $employeeDto = $this->userFactory->makeDTOFromModel($employeeModel);
            $fullNameEmployee = $this->pmManagementHandler->getUserName($employeeDto->getFirstName(), $employeeDto->getLastName());
            $teamInformation['team'][$employeeId]['name'] = $fullNameEmployee;
            $teamInformation['team'][$employeeId]['email'] = $employeeDto->getEmail();
            $teamInformation['team'][$employeeId]['avatar'] = $employeeDto->getGoogleAvatar();
            $teamInformation['team'][$employeeId]['country'] = $employeeDto->getCountryId() ? $this->countriesRepository->searchCountryById($employeeDto->getCountryId()) : null;
        }
        return $teamInformation;
    }

    /**
     * @param $idPm
     * @param $emailEmployee
     * @return bool
     */
    public function addEmployee($idPm, $emailEmployee): bool
    {
        $employeeId = $this->userRepository->getUserIdByEmail($emailEmployee);
        $modelEmployee = $this->employeesAndPmRepository->getModelTeamPm($idPm, $employeeId);
        if ($modelEmployee) {
            return false;
        } else {
            try {
                $this->employeesAndPmRepository->createTeam($idPm, $employeeId);
            } catch (Exception $e) {
                return false;
            }
            return true;
        }
    }

    /**
     * @param $idPm
     * @param $employeeId
     * @return bool
     */
    public function removeEmployee($idPm, $employeeId): bool
    {
        try {
            $this->employeesAndPmRepository->getModelTeamPm($idPm, $employeeId)->delete();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
