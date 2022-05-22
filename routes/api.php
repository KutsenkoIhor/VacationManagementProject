<?php

use App\Http\Controllers\VacationApprovalController;
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
Route::prefix('vacations')->name('vacations.')->middleware('auth')->group(function () {
    Route::post('/{vacation}/createVacationApproval', [VacationApprovalController::class, 'createVacationApproval'])->name('createVacationApproval');
});

//Route::post('/vacations', [VacationController::class, 'createVacation']);
//Route::get('/vacations', [VacationController::class, 'getVacations']);
//Route::get('/vacations/{vacation}', [VacationController::class, 'getVacation']);
//Route::post('/vacations/{vacation}', [VacationController::class, 'updateVacation']);
//Route::delete('/vacations/{vacation}', [VacationController::class, 'deleteVacation']);
//Route::post('/vacations/{vacation}/createVacationApproval', [VacationController::class, 'createVacationApproval'])->middleware('auth');
Route::get('/vacations/getVacationApprovalByRole', [VacationApprovalController::class, 'getVacationApprovalByRole']); //TODO:: remove
