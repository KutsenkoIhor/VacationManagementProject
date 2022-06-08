<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesAndCities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $countriesAndCities = [
            'Ukraine' => ['Kyiv', 'Odessa', 'Lviv', 'Zhytomyr'],
            'Bulgaria' => ['Sofia', 'Plovdiv', 'Varna', 'Burgas', 'Ruse', 'Stara Zagora'],
            'Serbia' => ['Belgrade', 'Bor', 'Čačak', 'Jagodina', 'Kikinda', 'Kraljevo', 'Kragujevac', 'Kruševac'],
            'Poland' => ['Warsaw', 'Kraków', 'Łódź', 'Wrocław', 'Poznań', 'Gdańsk'],
            'England' => ['Liverpool', 'London'],
        ];

        foreach ($countriesAndCities as $country => $arrCities) {
            $modelCountry = $this->createCountry($country);
            $countryId = $modelCountry->id;
            foreach ($arrCities as $city) {
                $this->createCity($countryId, $city);
            }
        }
    }

    private function createCountry(string $country): Country
    {
        return Country::create([
            'title' => $country,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    private function createCity(int $countryId, string $city): void
    {
        City::create([
            'country_id' => $countryId,
            'title' => $city,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
