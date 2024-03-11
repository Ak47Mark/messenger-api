<?php

use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::guard('web')->check()) {
        return redirect('/messenger');
    }
    return redirect('/login');
});

Route::get('/login', function () {
    return view('user.login');
})->name('login');

Route::get('/registration', function () {
    return view('user.registration');
});

Route::get('/messenger', [MessagesController::class, 'messagePage']);
