<?php

namespace App\Handlers;

use App\Factories\EmployeePmFactory;
use App\Factories\UserFactory;
use App\Repositories\EmployeesAndPmRepository;
use App\Repositories\UserRepository;

class PmManagementHandler
{
    private UserRepository $userRepository;
    private EmployeesAndPmRepository $employeesAndPmRepository;
    private UserFactory $userFactory;
    private EmployeePmFactory $employeePmFactory;

    public function __construct(
        UserRepository $userRepository,
        EmployeesAndPmRepository $employeesAndPmRepository,
        UserFactory $userFactory,
        EmployeePmFactory $employeePmFactory,

    )
    {
        $this->userRepository = $userRepository;
        $this->employeesAndPmRepository = $employeesAndPmRepository;
        $this->userFactory = $userFactory;
        $this->employeePmFactory = $employeePmFactory;
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

    /**
     * @return array
     */
    public function getArrUserIdWithRole(): array
    {
        $arrUserId = [];
        $collectionUsers = $this->userRepository->all();
        foreach ($collectionUsers as $userModel) {
            if ($userModel->hasRole('PM')) {
                $dataUser = $this->userFactory->makeDTOFromModel($userModel);
                $arrUserId[] = $dataUser->getId();
            }
        }
        return $arrUserId;
    }

    /**
     * @return array
     */
    public function getIdPmAndIdEmployee(): array
    {
        $collectionUsersPm = $this->employeesAndPmRepository->allCollection();
        $arrIdPm = [];
        foreach ($collectionUsersPm as $modelUsersPm) {
            $dataPm = $this->employeePmFactory->makeDTOFromModel($modelUsersPm);
            $arrIdPm[$dataPm->getIdPm()][] = $dataPm->getIdEmployee();
        }
        return $arrIdPm;
    }

    /**
     * @param $arrIdTeam
     * @return array
     */
    public function teamInformation($arrIdTeam): array
    {
        $arrUserAvatar = [];
        foreach ($arrIdTeam as $idUser) {
            $userModel = $this->userRepository->getUserParameters($idUser);
            $arrUserAvatar[] = $userModel->getGoogleAvatar();
        }
        return array_slice($arrUserAvatar, 0, 4);
    }

    /**
     * @param int $idPm
     * @return array
     */
    public function getArrIdTeam(int $idPm): array
    {
        $teamCollection = $this->employeesAndPmRepository->getCollectionTeamOnePm($idPm);
        $arrIdTeam = [];
        foreach ($teamCollection as $teamModel) {
            $dtoTeam = $this->employeePmFactory->makeDTOFromModel($teamModel);
            $arrIdTeam[] = $dtoTeam->getIdEmployee();
        }
        return $arrIdTeam;
    }
}
