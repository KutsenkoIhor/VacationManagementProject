<?php

namespace App\Services;

use App\Factories\CityFactory;
use App\Factories\CountryFactory;
use App\Factories\RoleFactory;
use App\Http\Requests\SaveNewUserRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ListEmployeesService
{
    private RoleFactory $roleFactory;
    private CountryFactory $countryFactory;
    private CityFactory $cityFactory;


    public function __construct(RoleFactory $roleFactory, CountryFactory $countryFactory, CityFactory $cityFactory)
    {
        $this->roleFactory = $roleFactory;
        $this->countryFactory = $countryFactory;
        $this->cityFactory = $cityFactory;
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
    public function createListEmployees(Collection $modelsCountries, Collection $modelsRole): array
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

    /**
     * @param Collection $dataCountriesAndCities
     * @param Collection $dataRole
     * @return JsonResponse
     */
    public function addNewUser(Collection $dataCountriesAndCities, Collection $dataRole): JsonResponse
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
        return response()->json($arrRolesAndDays);
    }

    public function takeIdCountry(Country $collectionCountry): int
    {
        $DTOCountry = $this->countryFactory->makeDTOFromModel($collectionCountry);
        return $DTOCountry->getId();
    }

    public function takeIdCity(City $collectionCity): int
    {
        $DTOCity = $this->cityFactory->makeDTOFromModel($collectionCity);
        return $DTOCity->getId();
    }

    public function saveUser(SaveNewUserRequest $request, int $idCountry, int $idCity): JsonResponse
    {
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


}



