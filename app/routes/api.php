<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessagesController;

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


// users
Route::post('/login', [AuthController::class, 'login']);
Route::post('/user', [UsersController::class, 'store']);

// messages
Route::post('/message', [MessagesController::class, 'store']);
Route::get('/message', [MessagesController::class, 'index']);
Route::get('/message/{id}', [MessagesController::class, 'show']);