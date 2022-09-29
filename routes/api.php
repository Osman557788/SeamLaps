<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProblemSolvingController;
use App\Http\Controllers\Api\UserController;
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


// problem solving

Route::get('getIndexOfString',[ProblemSolvingController::class,'getIndexOfString']);
Route::get('getCountOfNumbers',[ProblemSolvingController::class,'getCountOfNumbers']);
Route::get('getMinimumNumberOfMoves',[ProblemSolvingController::class,'getMinimumNumberOfMoves']);




Route::post('auth/login',[AuthController ::class,'login']);
Route::post('auth/register',[AuthController ::class,'register']);

Route::get('auth/logout',[AuthController ::class,'logout'])->middleware('auth:sanctum');

Route::resource('/user',UserController::class);