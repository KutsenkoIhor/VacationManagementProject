<?php

use App\Http\Controllers\SocialController;
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

Route::get('/', [SocialController::class, 'googleRedirect']);
Route::get('/auth/google/callback', [SocialController::class, 'loginWithGoogle']);

//Route::get('/', function () {
//    return Socialite::driver('google')->redirect();
//
//});
//
//Route::get('auth/google/callback', function () {
//    $user = Socialite::driver('google')->stateless()->user();
//    print_r($user->name);
//});
