<?php

use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DomainsController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\HrManagementController;
use App\Http\Controllers\ListEmployeesController;
use App\Http\Controllers\PmManagementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\VacationRequestController;
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
Route::get('/auth_error', function () {
    return view('errors.authError');
})->name('auth.error');

Route::name('page.')->group(function () {
    Route::get('/home', [HomePageController::class, 'getUserParametersByUserId'])
        ->middleware('auth')->name('homePage');

    Route::get('/holidayRequest', function () {
        return view('pages.holidayRequestPage');
    })->middleware('auth')->name('holidayRequest');

    Route::prefix('/listOfAllEmployees')->middleware('auth')->group(function () {
        Route::get('/', [ListEmployeesController::class, 'listEmployees'])->name('listOfAllEmployees');
        Route::post('/addUser', [ListEmployeesController::class, 'addUser']);
        Route::post('/saveUser', [ListEmployeesController::class, 'saveUser']);
        Route::post('/deleteUser', [ListEmployeesController::class, 'deleteUser']);
        Route::post('/editUser', [ListEmployeesController::class, 'UserInformationForEdit']);
        Route::post('/updateUser', [ListEmployeesController::class, 'updateUser']);
        Route::get('/createEmployeeDataTable', [ListEmployeesController::class, 'createEmployeeDataTable']);
        Route::post('/createEmployeeDataTable', [ListEmployeesController::class, 'getPaginateAndElasticsearchData']);
    });

    Route::prefix('/managementPM')->middleware('auth')->group(function () {
        Route::get('/',[PmManagementController::class, 'listPm'])->name('listPm');
        Route::get('/listPm',[PmManagementController::class, 'createListPm']);
        Route::post('/teamPm',[PmManagementController::class, 'createTeamPm']);
        Route::post('/teamPm/addEmployee', [PmManagementController::class, 'addEmployeeInTeam']);
        Route::post('/teamPm/deleteEmployee', [PmManagementController::class, 'removeEmployeeFromTeam']);
    });

    Route::prefix('/managementHR')->middleware('auth')->group(function () {
        Route::get('/',[HRManagementController::class, 'listHr'])->name('listHr');
    });

    Route::get('/publicHoliday', function () {
        return view('pages.publicHolidayPage');
    })->middleware('auth')->name('publicHoliday');

    Route::get('/settingsPage', function () {
        return view('pages.settingsPage');
    })->middleware('auth')->name('settingsPage');

    Route::get('/profile', function () {
        return view('pages.profile');
    })->middleware('auth')->name('profile');

});

Route::prefix('vacations')->name('vacations.')->middleware('auth')->group(function () {

    Route::get('/upcoming', [VacationController::class, 'getUpcomingVacations'])->name('upcoming');

    Route::get('/history/{id}', [VacationController::class, 'getVacationsByUserId'])->name('history');

    Route::get('/requestHistory', [VacationRequestController::class, 'getVacationRequestsByUserId'])->name('requestHistory');

    Route::get('/requests', [VacationRequestController::class, 'getEmployeesVacationRequests'])->name('requests');
});


//Settings
Route::middleware(['auth'])->group(function () {
//Countries
    Route::get('/settings/countries', [CountriesController::class, 'index'])->middleware('can:show countries')->name('countries.index');
    Route::get('/settings/countries/add-form', [CountriesController::class, 'addCountryForm'])->middleware('can:add countries')->name('countries.add.form');
    Route::post('/settings/countries/add', [CountriesController::class, 'addCountry'])->middleware('can:add countries')->name('countries.add');
    Route::get('/settings/countries/edit-form/{id}', [CountriesController::class, 'editCountryForm'])->middleware('can:edit countries')->name('countries.edit.form');
    Route::put('/settings/countries/edit/{id}', [CountriesController::class, 'editCountry'])->middleware('can:edit countries')->name('countries.edit');
    Route::delete('/settings/countries/delete/{id}', [CountriesController::class, 'deleteCountry'])->middleware('can:delete countries')->name('countries.delete');
//Cities
    Route::get('/settings/cities', [CitiesController::class, 'index'])->middleware('can:show cities')->name('cities.index');
    Route::get('/settings/cities/add-form', [CitiesController::class, 'addCityForm'])->middleware('can:add cities')->name('cities.add.form');
    Route::post('/settings/cities/add', [CitiesController::class, 'addCity'])->middleware('can:add cities')->name('cities.add');
    Route::get('/settings/cities/edit-form/{id}', [CitiesController::class, 'editCityForm'])->middleware('can:edit cities')->name('cities.edit.form');
    Route::put('/settings/cities/edit/{id}', [CitiesController::class, 'editCity'])->middleware('can:edit cities')->name('cities.edit');
    Route::delete('/settings/cities/delete/{id}', [CitiesController::class, 'deleteCity'])->middleware('can:delete cities')->name('cities.delete');
});

//Roles

Route::resource('settings/roles', RoleController::class)->middleware('role:System Admin');
Route::resource('settings/domains', DomainsController::class)->middleware('role:System Admin');

