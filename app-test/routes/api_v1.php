<?php

use App\Http\Controllers\API\V1\TicketController;
use App\Http\Controllers\API\V1\UserController;
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

Route::middleware(
    'auth:sanctum'
)->apiResource('tickets', TicketController::class);
Route::middleware(
    'auth:sanctum'
)->apiResource('users', \App\Http\Controllers\API\V1\UserController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [\App\Http\Controllers\API\V1\UserController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\API\V1\UserController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    // Route::post('/users/{id}',[UserController::class,'logout']);
});
