<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('home');
});

// routing admin 
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('/admin/home');
    })->middleware('auth');

    Route::get('/home', function () {
        return view('/admin/home');
    })->middleware('auth');
});

// routing user

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/register', [UserController::class, 'create']);
Route::post('/register-user', [UserController::class, 'store']);

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login-action', [UserController::class, 'loginaction']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/logout', [UserController::class, 'logout']);
