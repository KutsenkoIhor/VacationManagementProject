<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveNewUserRequest;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ListOfAllEmployees extends Controller
{
    public function saveUser(SaveNewUserRequest $request): JsonResponse
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


        $countryID = Countries::select('id')
            -> where('title', $request->get('country'))
            ->get();
        $data['countryID'] = $countryID;



//        $cityId = Cities::where('title', $request->get('city'))->get();
        $cityId = Cities::where([
                ['title', $request->get('city')],
                ['country_id', $countryID],
                ])->get();

        $data['cityId'] = $cityId;




        DB::transaction(function ($request){

        });
////
//            $countryID = Countries::select('id')
//                -> where('title', $request->get('country'))
//                ->first();
////
////            dd($countryID);
//////            $cityID = User::where('email', $email)->first();
////
//////            User::create([
//////                'first_name' => $request->get('firstName'),
//////                'last_name' => $request->get('lastName'),
//////                'email' => $request->get('email'),
//////            ]);



        return response()->json($data);


    }

    public function addUser()
    {
        $dataCountriesAndCities = Countries::all();
        $arrCountriesAndCities = [];
        foreach ($dataCountriesAndCities as $country) {
            $arrCities = [];
            foreach ($country->cities as $city) {
                $arrCities[] = $city['title'];
            }
            $arrCountriesAndCities[$country['title']] = $arrCities;
        }

        $data = Roles::all();
        $arrRolesAndDays = [];
        foreach ($data as $u) {
            $arrRolesAndDays['roles'][] = $u->role;
            $arrRolesAndDays[$u->role]['role'] = $u->role;
            $arrRolesAndDays[$u->role]['vacations'] = $u->vacations;
            $arrRolesAndDays[$u->role]['personal_days'] = $u->personal_days;
            $arrRolesAndDays[$u->role]['sick_days'] = $u->sick_days;
        }
        $arrRolesAndDays['CountriesAndCities'] = $arrCountriesAndCities;
        return response()->json($arrRolesAndDays);
    }

    public function getRoles()
    {

        $dataCountries = Countries::orderBy('title')->get();
        $arrCountries = [];
        foreach ($dataCountries as $value) {
            $arrCountries[] = $value->title;
        }
//        dd($arrCountries);

        $data = Roles::all();
        $arrRolesAndDays = [];
        foreach ($data as $u) {
//            $arrRolesAndDays[] = $u->role;
            $arrRolesAndDays['roles'][] = $u->role;
            $arrRolesAndDays[$u->role]['role'] = $u->role;
            $arrRolesAndDays[$u->role]['vacations'] = $u->vacations;
            $arrRolesAndDays[$u->role]['personal_days'] = $u->personal_days;
            $arrRolesAndDays[$u->role]['sick_days'] = $u->sick_days;
        }
        $json = json_encode($arrRolesAndDays);
        $arr['arr'] =  $arrRolesAndDays;
        $arr['json'] = $json;
        $arr['countries'] = $arrCountries;
//        dd($arr);
        return view('pages.listOfAllEmployeesPage', ['arrRolee' => $arr]);

//        return view('pages.listOfAllEmployeesPage', ['arrRolee' => $arrRolee]);
    }
}
