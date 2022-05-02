<?php

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

    Route::get('/listOfEmployees', function () {
        return view('pages.listOfEmployeesPage');
    })->middleware('auth')->name('listOfEmployees');

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





Route::get('/createVacation', function () {
    return view('vacations/creation');
})->middleware('auth')->name('createVacation');

Route::get('/upcomingVacations', [VacationController::class, 'getUpcomingVacations'])->middleware('auth');
Route::post('/vacations', [VacationController::class, 'createVacation'])->middleware('auth');
Route::get('/vacationList/{userId}', [VacationController::class, 'getVacationsByUserId'])->middleware('auth');
