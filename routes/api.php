<?php

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
    Route::post('/{id}/createVacationRequestApproval', [VacationRequestApprovalController::class, 'createVacationRequestApproval'])->name('createVacationRequestApproval');
});
