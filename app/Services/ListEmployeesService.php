<?php

namespace App\Services;

use App\Factories\CityFactory;
use App\Factories\CountryFactory;
use App\Factories\RoleFactory;
use App\Factories\UserFactory;
use App\Handlers\ListEmployeesHandler;
use App\Http\Requests\SaveNewUserRequest;
use App\Http\Requests\UpdateNewUserRequest;
use App\Models\User;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\VacationDaysLeftRepository;
use App\Repositories\VacationDaysPerYearRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ListEmployeesService
{
    private RoleFactory $roleFactory;
    private CountryFactory $countryFactory;
    private CityFactory $cityFactory;
    private UserFactory $userFactory;
    private CountryRepositoryInterface $countryRepository;
    private CityRepositoryInterface $cityRepository;
    private UserRepository $userRepository;
    private VacationDaysPerYearRepository $vacationDaysPerYearRepository;
    private VacationDaysLeftRepository $vacationDaysLeftRepository;
    private ListEmployeesHandler $listEmployeesHandler;


    public function __construct(
        RoleFactory $roleFactory,
        CountryFactory $countryFactory,
        CityFactory $cityFactory,
        UserFactory $userFactory,
        CountryRepositoryInterface $countryRepository,
        CityRepositoryInterface $cityRepository,
        UserRepository $userRepository,
        VacationDaysPerYearRepository $vacationDaysPerYearRepository,
        VacationDaysLeftRepository $vacationDaysLeftRepository,
        ListEmployeesHandler $listEmployeesHandler,
    )
    {
        $this->roleFactory = $roleFactory;
        $this->countryFactory = $countryFactory;
        $this->cityFactory = $cityFactory;
        $this->countryRepository = $countryRepository;
        $this->cityRepository = $cityRepository;
        $this->userRepository = $userRepository;
        $this->vacationDaysPerYearRepository = $vacationDaysPerYearRepository;
        $this->vacationDaysLeftRepository = $vacationDaysLeftRepository;
        $this->userFactory = $userFactory;
        $this->listEmployeesHandler = $listEmployeesHandler;
    }

    /**
     * @param Collection $modelsRole
     * @return array
     */
    public function getRolesAndDays(Collection $modelsRole): array
    {
        $arrRolesAndDays = [];
        foreach ($modelsRole as $modelRole) {

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
     * @param Collection $modelsCountries
     * @param Collection $modelsRole
     * @return array
     */
    public function modalWindow(Collection $modelsCountries, Collection $modelsRole): array
    {
        $arrData = [];
        $arrCountries = [];
        foreach ($modelsCountries as $modelCountries) {
            $CountriesDTO = $this->countryFactory->makeDTOFromModel($modelCountries);
            $arrCountries[] = $CountriesDTO->getCountry();
        }

        $arrRolesAndDays = $this->getRolesAndDays($modelsRole);
        $arrData['arr'] =  $arrRolesAndDays;
        $arrData ['countries'] = $arrCountries;
        return $arrData;
    }

    public function dataForElasticsearch():array
    {
        $userInformation = [];
        $userModels = $this->userRepository->all();
        foreach ($userModels as $userModel) {
            $dataUser = $this->userFactory->makeDTOFromModel($userModel);
            $userID = $dataUser->getId();
            $fullName = $this->listEmployeesHandler->getUserName($dataUser->getFirstName(), $dataUser->getLastName());

//            $userInformation[$userID]['userId'] = $userID;
            $userInformation[$userID]['email'] = $dataUser->getEmail();
            $userInformation[$userID]['name'] = $fullName;
        }
        return $userInformation;
    }

    public function employeeInformationById ($userId): array
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

    public function listEmployeesInformation($x): array
    {
        $elasticsearch = json_decode($x->get('elasticsearch'), true);
        if ($elasticsearch !== []) {
            $arrIdUserElasticsearch = $this->listEmployeesHandler->getIdFromArrElasticsearch($elasticsearch);
            $userInformation = [];
            $userModels = $this->userRepository->Elasticsearchpagination($arrIdUserElasticsearch);
            foreach ($userModels as $userModel) {
                $dataUser = $this->userFactory->makeDTOFromModel($userModel);
                $userID = $dataUser->getId();
                $fullName = $this->listEmployeesHandler->getUserName($dataUser->getFirstName(), $dataUser->getLastName());
                $arrUserRoles = $this->listEmployeesHandler->getArrRoles($userModel);
                $strUserRoles = $this->listEmployeesHandler->getStrRoles($userModel);
                $country = $dataUser->getCountryId() ? $this->countryRepository->searchCountryById($dataUser->getCountryId()) : null;
                $city = $dataUser->getCityId() ? $this->cityRepository->searchCityById($dataUser->getCityId()) : null;
                $vacationDayLeft = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->vacations : null;
                $personalDayLeft = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->personal_days : null;
                $sickDayLeft = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->sick_days : null;
                $vacationDayPerYear = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->vacations : null;
                $personalDayPerYear = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->personal_days : null;
                $sickDayPerYear = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->sick_days: null;

                $userInformation[$userID]['userId'] = $userID;
                $userInformation[$userID]['email'] = $dataUser->getEmail();
                $userInformation[$userID]['name'] = $fullName;
                $userInformation[$userID]['roles'] = $strUserRoles;
                $userInformation[$userID]['rolesArr'] =$arrUserRoles;
                $userInformation[$userID]['country'] = $country;
                $userInformation[$userID]['city'] = $city;
                $userInformation[$userID]['vacation days left'] = $vacationDayLeft;
                $userInformation[$userID]['personal days left'] = $personalDayLeft;
                $userInformation[$userID]['sick days left'] = $sickDayLeft;
                $userInformation[$userID]['vacation days per year'] = $vacationDayPerYear;
                $userInformation[$userID]['personal days per year'] = $personalDayPerYear;
                $userInformation[$userID]['sick days per year'] = $sickDayPerYear;
            }
            $dataInformation = [];
            $dataInformation['userInfo'] = $userInformation;
            $dataInformation['userModel'] = $userModels;
            return $dataInformation;
        } else {
            if ($x->get('countrySort') !== 'All') {
                $idCountry = $this->countryRepository->searchIdByCountry($x->get('countrySort'));
            } else {
                $idCountry = 'All';
            }
            if ($x->get('citySort') !== 'All') {
                $idCity = $this->cityRepository->searchIdByCity($x->get('citySort'));
            } else {
                $idCity = 'All';
            }

            $arrIdRole = [];
            if ($x->get('roleSort') !== 'All') {
                $userss = User::role($x->get('roleSort'))->get();
                foreach ($userss as $user) {
                    $arrIdRole[$user['id']] = $user['id'];
                }
            }




//            dd($idCity);

            $userInformation = [];
            $userModels = $this->userRepository->allPagination($arrIdRole, $idCountry, $idCity);
            foreach ($userModels as $userModel) {
                $dataUser = $this->userFactory->makeDTOFromModel($userModel);
                $userID = $dataUser->getId();
                $fullName = $this->listEmployeesHandler->getUserName($dataUser->getFirstName(), $dataUser->getLastName());
                $arrUserRoles = $this->listEmployeesHandler->getArrRoles($userModel);
                $strUserRoles = $this->listEmployeesHandler->getStrRoles($userModel);
                $country = $dataUser->getCountryId() ? $this->countryRepository->searchCountryById($dataUser->getCountryId()) : null;
                $city = $dataUser->getCityId() ? $this->cityRepository->searchCityById($dataUser->getCityId()) : null;
                $vacationDayLeft = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->vacations : null;
                $personalDayLeft = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->personal_days : null;
                $sickDayLeft = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->sick_days : null;
                $vacationDayPerYear = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->vacations : null;
                $personalDayPerYear = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->personal_days : null;
                $sickDayPerYear = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->sick_days: null;

                $userInformation[$userID]['userId'] = $userID;
                $userInformation[$userID]['email'] = $dataUser->getEmail();
                $userInformation[$userID]['name'] = $fullName;
                $userInformation[$userID]['roles'] = $strUserRoles;
                $userInformation[$userID]['rolesArr'] =$arrUserRoles;
                $userInformation[$userID]['country'] = $country;
                $userInformation[$userID]['city'] = $city;
                $userInformation[$userID]['vacation days left'] = $vacationDayLeft;
                $userInformation[$userID]['personal days left'] = $personalDayLeft;
                $userInformation[$userID]['sick days left'] = $sickDayLeft;
                $userInformation[$userID]['vacation days per year'] = $vacationDayPerYear;
                $userInformation[$userID]['personal days per year'] = $personalDayPerYear;
                $userInformation[$userID]['sick days per year'] = $sickDayPerYear;
            }
            $dataInformation = [];
            $dataInformation['userInfo'] = $userInformation;
            $dataInformation['userModel'] = $userModels;
            return $dataInformation;
        }

//        $userInformation = [];
//        $userModels = $this->userRepository->allPagination();
//        foreach ($userModels as $userModel) {
//            $dataUser = $this->userFactory->makeDTOFromModel($userModel);
//            $userID = $dataUser->getId();
//            $fullName = $this->listEmployeesHandler->getUserName($dataUser->getFirstName(), $dataUser->getLastName());
//            $arrUserRoles = $this->listEmployeesHandler->getArrRoles($userModel);
//            $strUserRoles = $this->listEmployeesHandler->getStrRoles($userModel);
//            $country = $dataUser->getCountryId() ? $this->countryRepository->searchCountryById($dataUser->getCountryId()) : null;
//            $city = $dataUser->getCityId() ? $this->cityRepository->searchCityById($dataUser->getCityId()) : null;
//            $vacationDayLeft = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->vacations : null;
//            $personalDayLeft = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->personal_days : null;
//            $sickDayLeft = $userModel->vacationDaysLeft ? $userModel->vacationDaysLeft->sick_days : null;
//            $vacationDayPerYear = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->vacations : null;
//            $personalDayPerYear = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->personal_days : null;
//            $sickDayPerYear = $userModel->vacationDaysPerYear ? $userModel->vacationDaysPerYear->sick_days: null;
//
//            $userInformation[$userID]['userId'] = $userID;
//            $userInformation[$userID]['email'] = $dataUser->getEmail();
//            $userInformation[$userID]['name'] = $fullName;
//            $userInformation[$userID]['roles'] = $strUserRoles;
//            $userInformation[$userID]['rolesArr'] =$arrUserRoles;
//            $userInformation[$userID]['country'] = $country;
//            $userInformation[$userID]['city'] = $city;
//            $userInformation[$userID]['vacation days left'] = $vacationDayLeft;
//            $userInformation[$userID]['personal days left'] = $personalDayLeft;
//            $userInformation[$userID]['sick days left'] = $sickDayLeft;
//            $userInformation[$userID]['vacation days per year'] = $vacationDayPerYear;
//            $userInformation[$userID]['personal days per year'] = $personalDayPerYear;
//            $userInformation[$userID]['sick days per year'] = $sickDayPerYear;
//        }
//        $dataInformation = [];
//        $dataInformation['userInfo'] = $userInformation;
//        $dataInformation['userModel'] = $userModels;
//        return $dataInformation;
    }

    /**
     * @param Collection $dataCountriesAndCities
     * @param Collection $dataRole
     * @return JsonResponse
     */
    public function addNewUser(Collection $dataCountriesAndCities, Collection $dataRole): array
    {
        $arrCountriesAndCities = [];
        foreach ($dataCountriesAndCities as $dataCountryAndCity) {
            $arrCities = [];
            foreach ($dataCountryAndCity->cities as $city) {
                $cityDTO = $this->cityFactory->makeDTOFromModel($city);
                $arrCities[] = $cityDTO->getCity();
            }
            $countryDTO = $this->countryFactory->makeDTOFromModel($dataCountryAndCity);
            $arrCountriesAndCities[$countryDTO->getCountry()] =  $arrCities;
        }

        $arrRolesAndDays = $this->getRolesAndDays($dataRole);

        $arrRolesAndDays['CountriesAndCities'] = $arrCountriesAndCities;
        return $arrRolesAndDays;
//        return response()->json($arrRolesAndDays);
    }

    public function takeIdCountry(SaveNewUserRequest|UpdateNewUserRequest $request): int
    {
        $collectionCountry = $this->countryRepository->searchByCountry($request->get('country'));
        $DTOCountry = $this->countryFactory->makeDTOFromModel($collectionCountry);
        return $DTOCountry->getId();
    }

    public function takeIdCity(int $idCountry, SaveNewUserRequest|UpdateNewUserRequest $request): int
    {
        $collectionCity = $this->cityRepository->searchByCountryIdAndCity($idCountry, $request->get('city'));
        $DTOCity = $this->cityFactory->makeDTOFromModel($collectionCity);
        return $DTOCity->getId();
    }

    public function saveUser(SaveNewUserRequest $request, int $idCountry, int $idCity): JsonResponse
    {
        DB::transaction(function () use ($request, $idCountry, $idCity) {
            $modelUser = $this->userRepository->updateOrCreate(
                $request->get('firstName'),
                $request->get('lastName'),
                $request->get('email'),
//                null,
                $idCountry,
                $idCity,
            );

            foreach ($request->get('roles') as $role) {
                $modelUser->assignRole($role);
            }

            $idUser = $modelUser["id"];

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

//---- для внутрышньої перевірки js----
        $data = [];
        $data['country'] = $request->get('country');
        $data['city'] = $request->get('city');
        $data['email'] = $request->get('email');
        $data['firstName'] = $request->get('firstName');
        $data['lastName"'] = $request->get('lastName');
        $data['vacationDays'] = $request->get('vacationDays');
        $data['sickDays'] = $request->get('sickDays');
        $data['personalDays'] = $request->get('personalDays');
        $data['arrRoles'] = $request->get('roles');
        $data['idCountry'] = $idCountry;
        $data['idCity'] = $idCity;
        return response()->json($data);

    }

    public function updateUser(UpdateNewUserRequest $request, int $idCountry, int $idCity): JsonResponse
    {
        DB::transaction(function () use ($request, $idCountry, $idCity) {
            $modelUser = $this->userRepository->updateOrCreate(
                $request->get('firstName'),
                $request->get('lastName'),
                $request->get('email'),
//                null,
                $idCountry,
                $idCity,
            );

            foreach ($modelUser->getRoleNames() as $role) {
                $modelUser->removeRole($role);
            }
            foreach ($request->get('roles') as $role) {
                $modelUser->assignRole($role);
            }

            $idUser = $modelUser["id"];

            $this->vacationDaysPerYearRepository->updateOrCreate(
                $idUser,
                $request->get('vacationDays'),
                $request->get('personalDays'),
                $request->get('sickDays'),
            );
        });
        //---- для внутрышньої перевірки js----
        $data = [];
        $data['country'] = $request->get('country');
        $data['city'] = $request->get('city');
        $data['email'] = $request->get('email');
        $data['firstName'] = $request->get('firstName');
        $data['lastName"'] = $request->get('lastName');
        $data['vacationDays'] = $request->get('vacationDays');
        $data['sickDays'] = $request->get('sickDays');
        $data['personalDays'] = $request->get('personalDays');
        $data['arrRoles'] = $request->get('roles');
        $data['idCountry'] = $idCountry;
        $data['idCity'] = $idCity;
        return response()->json($data);
    }

    public function deleteUser(int $userId): JsonResponse
    {
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
            foreach ($userModel->getRoleNames() as $role) {
                $userModel->removeRole($role);
            }
            $userModel->delete();

        });

        return response()->json($userId);
    }


}



