<?php

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
