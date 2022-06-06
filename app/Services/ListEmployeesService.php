<?php

namespace App\Services;

use App\Factories\CityFactory;
use App\Factories\CountryFactory;
use App\Factories\RoleFactory;
use App\Factories\UserFactory;
use App\Handlers\ListEmployeesHandler;
use App\Http\Requests\SaveNewUserRequest;
use App\Http\Requests\UpdateNewUserRequest;
use App\Repositories\Interfaces\ListEmployees\ListEmployeesCityRepositoryInterface;
use App\Repositories\Interfaces\ListEmployees\ListEmployeesCountryRepositoryInterface;
use App\Repositories\Interfaces\ListEmployees\ListEmployeesRoleRepositoryInterface;
use App\Repositories\Interfaces\ListEmployees\ListEmployeesUserRepositoryInterface;
use App\Repositories\Interfaces\ListEmployees\ListEmployeesVacationDaysLeftRepositoryInterface;
use App\Repositories\Interfaces\ListEmployees\ListEmployeesVacationDaysPerYearRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListEmployeesService
{
    private RoleFactory $roleFactory;
    private CountryFactory $countryFactory;
    private CityFactory $cityFactory;
    private UserFactory $userFactory;
    private ListEmployeesCountryRepositoryInterface $countryRepository;
    private ListEmployeesRoleRepositoryInterface $roleRepository;
    private ListEmployeesUserRepositoryInterface $userRepository;
    private ListEmployeesCityRepositoryInterface $cityRepository;
    private ListEmployeesVacationDaysLeftRepositoryInterface $vacationDaysLeftRepository;
    private ListEmployeesVacationDaysPerYearRepositoryInterface $vacationDaysPerYearRepository;
    private ListEmployeesHandler $listEmployeesHandler;


    public function __construct(
        RoleFactory                                         $roleFactory,
        CountryFactory                                      $countryFactory,
        CityFactory                                         $cityFactory,
        UserFactory                                         $userFactory,
        ListEmployeesCountryRepositoryInterface             $listEmployeesCountryRepository,
        ListEmployeesRoleRepositoryInterface                $listEmployeesRoleRepository,
        ListEmployeesUserRepositoryInterface                $listEmployeesUserRepository,
        ListEmployeesCityRepositoryInterface                $listEmployeesCityRepository,
        ListEmployeesVacationDaysLeftRepositoryInterface    $listEmployeesVacationDaysLeftRepository,
        ListEmployeesVacationDaysPerYearRepositoryInterface $listEmployeesVacationDaysPerYearRepository,
        ListEmployeesHandler                 $listEmployeesHandler,
    )
    {
        $this->roleFactory = $roleFactory;
        $this->countryFactory = $countryFactory;
        $this->cityFactory = $cityFactory;
        $this->userFactory = $userFactory;
        $this->countryRepository = $listEmployeesCountryRepository;
        $this->roleRepository = $listEmployeesRoleRepository;
        $this->userRepository = $listEmployeesUserRepository;
        $this->cityRepository = $listEmployeesCityRepository;
        $this->vacationDaysLeftRepository = $listEmployeesVacationDaysLeftRepository;
        $this->vacationDaysPerYearRepository = $listEmployeesVacationDaysPerYearRepository;
        $this->listEmployeesHandler = $listEmployeesHandler;
    }

    /**
     * @return array
     */
    public function getCountries(): array
    {
        $collectionCountries = $this->countryRepository->orderBy('title');
        $arrCountries = [];
        foreach ($collectionCountries as $modelCountries) {
            $CountriesDTO = $this->countryFactory->makeDTOFromModel($modelCountries);
            $arrCountries[] = $CountriesDTO->getCountry();
        }
        return $arrCountries;
    }

    /**
     * @return array
     */
    public function getRolesAndDays(): array
    {
        $collectionRole = $this->roleRepository->all();
        $arrRolesAndDays = [];
        foreach ($collectionRole as $modelRole) {
            $roleAndDaysDTO = $this->roleFactory->makeDTOFromModel($modelRole);
            $arrRolesAndDays["roles"][] = $roleAndDaysDTO->getName();
            $arrRolesAndDays[$roleAndDaysDTO->getName()]['role'] = $roleAndDaysDTO->getName();
            $arrRolesAndDays[$roleAndDaysDTO->getName()]['personal_days'] = $roleAndDaysDTO->getPersonalDays();
            $arrRolesAndDays[$roleAndDaysDTO->getName()]['sick_days'] = $roleAndDaysDTO->getSickDays();
            $arrRolesAndDays[$roleAndDaysDTO->getName()]['vacations'] = $roleAndDaysDTO->getVacationsDays();
        }
        return $arrRolesAndDays;
    }

    /**
     * @return array
     */
    public function getCountriesAndCities(): array
    {
        $collectionCountriesAndCities = $this->countryRepository->all();
        $arrCountriesAndCities = [];
        foreach ($collectionCountriesAndCities as $modelCountryAndCity) {
            $arrCities = [];
            foreach ($modelCountryAndCity->cities as $city) {
                $cityDTO = $this->cityFactory->makeDTOFromModel($city);
                $arrCities[] = $cityDTO->getCity();
            }
            $countryDTO = $this->countryFactory->makeDTOFromModel($modelCountryAndCity);
            $arrCountriesAndCities[$countryDTO->getCountry()] =  $arrCities;
        }
        return $arrCountriesAndCities;
    }

    /**
     * @param int $userId
     * @return array
     */
    public function getEmployeeInformationById(int $userId): array
    {
        $userInformation = [];
        $userModel = $this->userRepository->getUserModelById($userId);
        $userParameters = $this->userFactory->makeDTOFromModel($userModel);
        $userInformation['firstName'] = $userParameters->getFirstName();
        $userInformation['lastName'] = $userParameters->getLastName();
        $userInformation['email'] = $userParameters->getEmail();
        $userInformation['country'] = $userParameters->getCountryId() ? $this->countryRepository->searchCountryById($userParameters->getCountryId()) : null;
        $userInformation['city'] = $userParameters->getCityId() ? $this->cityRepository->searchCityById($userParameters->getCityId()) : null;
        $userInformation['rolesArr'] = $this->listEmployeesHandler->getArrRoles($userModel);
        $userInformation['vacation days per year'] = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->vacations : null;
        $userInformation['personal days per year'] = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->personal_days : null;
        $userInformation['sick days per year'] = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->sick_days: null;
        return $userInformation;
    }

    /**
     * @param SaveNewUserRequest|UpdateNewUserRequest $request
     * @return int
     */
    public function getIdCountry(SaveNewUserRequest|UpdateNewUserRequest $request): int
    {
        $modelCountry = $this->countryRepository->searchByCountry($request->get('country'));
        $DTOCountry = $this->countryFactory->makeDTOFromModel($modelCountry);
        return $DTOCountry->getId();
    }

    /**
     * @param int $idCountry
     * @param SaveNewUserRequest|UpdateNewUserRequest $request
     * @return int
     */
    public function getIdCity(int $idCountry, SaveNewUserRequest|UpdateNewUserRequest $request): int
    {
        $collectionCity = $this->cityRepository->searchByCountryIdAndCity($idCountry, $request->get('city'));
        $DTOCity = $this->cityFactory->makeDTOFromModel($collectionCity);
        return $DTOCity->getId();
    }

    /**
     * @param SaveNewUserRequest $request
     * @param int $idCountry
     * @param int $idCity
     * @return bool
     */
    public function saveUser(SaveNewUserRequest $request, int $idCountry, int $idCity): bool
    {
        try {
            DB::transaction(function() use ($request, $idCountry, $idCity) {
                $modelUser = $this->userRepository->updateOrCreate(
                    $request->get('firstName'),
                    $request->get('lastName'),
                    $request->get('email'),
                    $idCountry,
                    $idCity,
                );
                $this->listEmployeesHandler->assignListRoles($request->get('roles'), $modelUser);
                $userDto = $this->userFactory->makeDTOFromModel($modelUser);
                $idUser = $userDto->getId();
                $this->vacationDaysPerYearRepository->updateOrCreate(
                    $idUser,
                    $request->get('vacationDays'),
                    $request->get('personalDays'),
                    $request->get('sickDays'),
                );
                $this->vacationDaysLeftRepository->create(
                    $idUser,
                    $request->get('vacationDays'),
                    $request->get('personalDays'),
                    $request->get('sickDays'),
                );
            });
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function deleteUser(int $userId): bool
    {
        try {
            DB::transaction(function () use ($userId){
                $userModel = $this->userRepository->getUserModelById($userId);
                $userModel->vacationDaysLeft()->delete();
                $userModel->vacationDaysPerYear()->delete();
                $userModel->vacations()->delete();
                $userModel->cityHr()->delete();
                $userModel->employeeHrForeignKeyEmployee()->delete();
                $userModel->employeeHrForeignKeyHr()->delete();
                $userModel->employeePmForeignKeyEmployee()->delete();
                $userModel->employeePmForeignKeyPm()->delete();
                $this->listEmployeesHandler->removeAllRole($userModel);
                $userModel->delete();
            });
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * @param UpdateNewUserRequest $request
     * @param int $idCountry
     * @param int $idCity
     * @return bool
     */
    public function updateUser(UpdateNewUserRequest $request, int $idCountry, int $idCity): bool
    {
        try {
            DB::transaction(function () use ($request, $idCountry, $idCity) {
                $modelUser = $this->userRepository->updateOrCreate(
                    $request->get('firstName'),
                    $request->get('lastName'),
                    $request->get('email'),
                    $idCountry,
                    $idCity,
                );
                $this->listEmployeesHandler->removeAllRole($modelUser);
                $this->listEmployeesHandler->assignListRoles($request->get('roles'), $modelUser);
                $userDto = $this->userFactory->makeDTOFromModel($modelUser);
                $idUser = $userDto->getId();
                $this->vacationDaysPerYearRepository->updateOrCreate(
                    $idUser,
                    $request->get('vacationDays'),
                    $request->get('personalDays'),
                    $request->get('sickDays'),
                );
            });
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * @return array
     */
    public function dataForElasticsearch():array
    {
        $userInformation = [];
        $collectionUsers = $this->userRepository->all();
        foreach ($collectionUsers as $userModel) {
            $dataUser = $this->userFactory->makeDTOFromModel($userModel);
            $userID = $dataUser->getId();
            $fullName = $this->listEmployeesHandler->getUserName($dataUser->getFirstName(), $dataUser->getLastName());
            $userInformation[$userID]['email'] = $dataUser->getEmail();
            $userInformation[$userID]['name'] = $fullName;
        }
        return $userInformation;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function listEmployeesInformation(Request $request): array
    {
        $elasticsearch = json_decode($request->get('elasticsearch'), true);
        if ($elasticsearch) {
            $arrIdUserElasticsearch = $this->listEmployeesHandler->getIdFromArrElasticsearch($elasticsearch);
            $userModels = $this->userRepository->elasticsearchPagination($arrIdUserElasticsearch);
        } else {
            $idCountry = ($request->get('countrySort') !== 'All') ? $this->countryRepository->searchIdByCountry($request->get('countrySort')) : 'All';
            $idCity = ($request->get('citySort') !== 'All') ? $this->cityRepository->searchIdByCity($request->get('citySort')) : 'All';
            $arrIdRole = ($request->get('roleSort') !== 'All') ? $this->listEmployeesHandler->getArrIdUsersWithSpecificRole($request->get('roleSort')) : [];
            $userModels = $this->userRepository->allPagination($arrIdRole, $idCountry, $idCity);
        }
        return $this->usersModelHandler($userModels);
    }

    /**
     * @param $userModels
     * @return array
     */
    private function usersModelHandler($userModels): array
    {
        $userInformation = [];
        foreach ($userModels as $userModel) {
            $dataUser = $this->userFactory->makeDTOFromModel($userModel);
            $userID = $dataUser->getId();
            $userInformation[$userID]['userId'] = $userID;
            $userInformation[$userID]['email'] = $dataUser->getEmail();
            $userInformation[$userID]['name'] = $this->listEmployeesHandler->getUserName($dataUser->getFirstName(), $dataUser->getLastName());
            $userInformation[$userID]['roles'] = $this->listEmployeesHandler->getStrRoles($userModel);
            $userInformation[$userID]['rolesArr'] =$this->listEmployeesHandler->getArrRoles($userModel);
            $userInformation[$userID]['country'] = $dataUser->getCountryId() ? $this->countryRepository->searchCountryById($dataUser->getCountryId()) : null;
            $userInformation[$userID]['city'] = $dataUser->getCityId() ? $this->cityRepository->searchCityById($dataUser->getCityId()) : null;
            $userInformation[$userID]['vacation days left'] = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->vacations : null;
            $userInformation[$userID]['personal days left'] = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->personal_days : null;
            $userInformation[$userID]['sick days left'] = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->sick_days : null;
            $userInformation[$userID]['vacation days per year'] = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->vacations : null;
            $userInformation[$userID]['personal days per year'] = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->personal_days : null;
            $userInformation[$userID]['sick days per year'] = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->sick_days: null;
        }
        $dataInformation = [];
        $dataInformation['userInfo'] = $userInformation;
        $dataInformation['userModel'] = $userModels;
        return $dataInformation;
    }
}
