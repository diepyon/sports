<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Auth::routes();

Route::prefix('login')->name('login.')->group(function() {
    Route::get('/line/redirect', [LoginController::class, 'redirectToProvider'])->name('line.redirect');
    Route::get('/line/callback', [LoginController::class, 'handleProviderCallback'])->name('line.callback');
});  

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');