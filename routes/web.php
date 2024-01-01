<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');


Route::resource('users', UserController::class);

Route::middleware(['auth'])->group(function () {
    // Dashboard route
    Route::get('/', function () {
        return view('welcome');
    })->name('dashboard');
});
