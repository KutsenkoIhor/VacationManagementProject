<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Countries;
use App\Models\Roles;
use Illuminate\Http\Request;

class ListOfAllEmployees extends Controller
{
    public function saveUser(Request $request)
    {
        $data = [];
        $data['country'] = $request->input('country');
        $data['city'] = $request->input('city');
        $data['email'] = $request->input('email');
        $data['firstName'] = $request->input('firstName');
        $data['lastName"'] = $request->input('lastName');
        $data['vacationDays'] = $request->input('vacationDays');
        $data['sickDays'] = $request->input('sickDays');
        $data['personalDays'] = $request->input('personalDays');
        $data['arrRoles'] = $request->input('roles');



        $validated = $request->validate([
            'firstName' => 'min:5|max:2',
            'country' => 'max:3',
        ]);

//        print_r($request);
//        $arrX = [1, 3, 4, 5];
        return response()->json($data);
//        return view('test', ['arrX ' => $arrX ]);

//        dd([1, 3, 4, 5]);
//        dd($request);

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
