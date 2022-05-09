<?php

use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/quantox', function () {
    return view('welcome');
})->middleware('auth')->name('dashboard');

Route::get('/quantoxq', function () {
    Auth::logout();
    return redirect(route('login'));
});

Route::get('/createVacation', function () {
    return view('vacations/creation');
})->middleware('auth');

Route::post('/vacations', [VacationController::class, 'createVacation'])->middleware('auth');
Route::get('/vacationList/{userId}', [VacationController::class, 'getVacationsByUserId'])->middleware('auth');

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
