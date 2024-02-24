<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ChallengeController;
use App\Http\Controllers\API\WechatController;
use App\Http\Controllers\API\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/user/qrcode',      [UserController::class, "qrcode"]);
    Route::get('/user/info',        [UserController::class, "info"]);
    Route::post('/user/info',       [UserController::class, "profile"]);
    Route::get('/user/challenge',   [UserController::class, "challenge"]);
    Route::post('/user/challenge',  [UserController::class, "startChallenge"]);
    Route::get('/user/team-overview',[UserController::class, "teamOverview"]);
    Route::get('/user/team-detail', [UserController::class, "teamDetail"]);
});
Route::get('/challenge/levels',     [ChallengeController::class, "levels"]);
Route::get('/challenge/stats',      [ChallengeController::class, "stats"]);
Route::get('/challenge/success',    [ChallengeController::class, "success"]);
Route::get('/challenge/range',      [ChallengeController::class, "range"]);
Route::post('/wxapp/register',      [WechatController::class, 'register']);
Route::post('/wxapp/login',         [WechatController::class, 'login']);
