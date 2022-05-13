<?php

use App\Http\Controllers\VacationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/vacations', [VacationController::class, 'createVacation']);
Route::get('/vacations', [VacationController::class, 'getVacations']);
Route::get('/vacations/{vacation}', [VacationController::class, 'getVacation']);
Route::post('/vacations/{vacation}', [VacationController::class, 'updateVacation']);
Route::delete('/vacations/{vacation}', [VacationController::class, 'deleteVacation']);
Route::post('/vacations/{vacation}/changeStatus', [VacationController::class, 'changeStatus']);
