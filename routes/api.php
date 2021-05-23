<?php

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\AuthenticationController;

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
Route::get('/pictures/{id}', [PictureController::class, 'show'])->middleware('App\Http\Middleware\React');
Route::get('/pictures/{id}/checkLike', [PictureController::class, 'checkLike'])->middleware('App\Http\Middleware\React');
Route::get('/pictures/{id}/handleLike', [PictureController::class, 'handleLike'])->middleware('App\Http\Middleware\React');
Route::post('/pictures/store', [PictureController::class, 'store'])->middleware('App\Http\Middleware\React');
Route::post('/pictures', [PictureController::class, 'search']);

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);


