<?php

use App\Http\Controllers\VacationController;
use App\Http\Controllers\VacationRequestApprovalController;
use App\Http\Controllers\VacationRequestController;
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
Route::prefix('vacationRequests')->name('vacationRequests.')->middleware('auth')->group(function () {
    Route::get('/{id}', [VacationRequestController::class, 'getVacationRequest'])->name('getVacationRequest');
    Route::post('/createVacationRequest', [VacationRequestController::class, 'createVacationRequest'])->name('createVacationRequest');
    Route::post('/{id}/updateVacationRequest', [VacationRequestController::class, 'updateVacationRequest'])->name('updateVacationRequest');
    Route::post('/{id}/createVacationRequestApproval', [VacationRequestApprovalController::class, 'createVacationRequestApproval'])->name('createVacationRequestApproval');
    Route::post('/{id}/cancelVacationRequest', [VacationRequestController::class, 'cancelVacationRequest'])->name('cancelVacationRequest');
});
