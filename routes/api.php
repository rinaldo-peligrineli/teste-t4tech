<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BalldontlieTeamsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/auth', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'personal.auth']], function () {

    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::get('user/search', [UserController::class, 'search']);

    Route::resource('users', UserController::class, ['only' => ['index', 'show', 'store', 'update']]);


    Route::resource('balldontlies/teams', BalldontlieTeamsController::class, ['only' => ['index', 'show', 'store', 'update']]);
    Route::get('balldontlies/team/search', [BalldontlieTeamsController::class, 'search']);

    Route::group(['middleware' => ['role:admin']], function () {
        Route::delete('users/delete/{id}', [UserController::class, 'delete']);
        Route::delete('balldontlies/teams/delete/{id}', [BalldontlieTeamsController::class, 'delete']);
    });
});






