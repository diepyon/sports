<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MatchingController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/map', [MapController::class, 'index']);
Route::get('/readStaticJson', [MapController::class, 'readStaticJson']);

Auth::routes();
//これでくくるとrequestがないとのエラーが出る
//Route::prefix('login')->name('login.')->group(function() {});
    Route::get('/line/redirect', [LoginController::class, 'redirectToProvider'])->name('line.redirect');
    Route::get('/line/callback', [LoginController::class, 'handleProviderCallback'])->name('line.callback');

    Route::get('/loggedin', [LoginController::class, 'loggedin']);
    Route::get('/hoge', [LoginController::class, 'hoge']);

Route::get('/matching', [MatchingController::class, 'index']);//あかんかったらpostに直す

