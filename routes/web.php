<?php

use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\VacationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SocialController::class, 'googleRedirect'])->name('login');
Route::get('/auth/google/callback', [SocialController::class, 'loginWithGoogle']);
Route::get('/logout',[HomePageController::class, 'logout'])->name('logout');

Route::name('page.')->group(function () {
    Route::get('/home', [HomePageController::class, 'getUserParametersByUserId'])
        ->middleware('auth')->name('homePage');

    Route::get('/holidayRequest', function () {
        return view('pages.holidayRequestPage');
    })->middleware('auth')->name('holidayRequest');

    Route::get('/vacationsHistory', function () {
        return view('pages.vacationsHistoryPage');
    })->middleware('auth')->name('vacationsHistory');

    Route::get('/overviewAllUserInVacation', function () {
        return view('pages.overviewAllUserInVacationPage');
    })->middleware('auth')->name('overviewAllUserInVacation');

    Route::get('/listOfAllEmployees', function () {
        return view('pages.listOfAllEmployeesPage');
    })->middleware('auth')->name('listOfAllEmployees');

    Route::get('/publicHoliday', function () {
        return view('pages.publicHolidayPage');
    })->middleware('auth')->name('publicHoliday');

    Route::get('/manageHRandPM', function () {
        return view('pages.manageHRandPMPage');
    })->middleware('auth')->name('manageHRandPM');

    Route::get('/settingsPage', function () {
        return view('pages.settingsPage');
    })->middleware('auth')->name('settingsPage');
});

Route::prefix('vacations')->name('vacations.')->middleware('auth')->group(function () {
    Route::post('/', [VacationController::class, 'createVacation'])->name('create');
    Route::get('/', function () {
        return view('vacations/creation');
    })->name('create.form');

    Route::get('/upcoming', [VacationController::class, 'getUpcomingVacations'])->name('upcoming');

    Route::get('/history', [VacationController::class, 'getVacationsByUserId'])->name('list');

    Route::get('/list', [VacationController::class, 'getVacationsWithStatusNew'])->name('listWithStatus');
});


//Location
Route::middleware(['auth'])->group(function () {
//Countries
    Route::get('/location/countries', [CountriesController::class, 'index'])->middleware('can:show countries')->name('countries.index');
    Route::get('/location/countries/add-form', [CountriesController::class, 'addCountryForm'])->middleware('can:add countries')->name('countries.add.form');
    Route::post('/location/countries/add', [CountriesController::class, 'addCountry'])->middleware('can:add countries')->name('countries.add');
    Route::get('/location/countries/edit-form/{id}', [CountriesController::class, 'editCountryForm'])->middleware('can:edit countries')->name('countries.edit.form');
    Route::put('/location/countries/edit/{id}', [CountriesController::class, 'editCountry'])->middleware('can:edit countries')->name('countries.edit');
    Route::delete('/location/countries/delete/{id}', [CountriesController::class, 'deleteCountry'])->middleware('can:delete countries')->name('countries.delete');
//Cities
    Route::get('/location/cities', [CitiesController::class, 'index'])->middleware('can:show cities')->name('cities.index');
    Route::get('/location/cities/add-form', [CitiesController::class, 'addCityForm'])->middleware('can:add cities')->name('cities.add.form');
    Route::post('/location/cities/add', [CitiesController::class, 'addCity'])->middleware('can:add cities')->name('cities.add');
    Route::get('/location/cities/edit-form/{id}', [CitiesController::class, 'editCityForm'])->middleware('can:edit cities')->name('cities.edit.form');
    Route::put('/location/cities/edit/{id}', [CitiesController::class, 'editCity'])->middleware('can:edit cities')->name('cities.edit');
    Route::delete('/location/cities/delete/{id}', [CitiesController::class, 'deleteCity'])->middleware('can:delete cities')->name('cities.delete');
});

//Roles
Route::resource('/roles', \App\Http\Controllers\RoleController::class)->middleware('role:System Admin');
