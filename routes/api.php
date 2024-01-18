<?php

use App\Http\Controllers\AuthenticationController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->get('/tes', function () {
    return response()->json('tes aja');
});

// Authentication
Route::controller(AuthenticationController::class)->group(function () {

    Route::middleware('auth')->group(function () {
        Route::post('/logout', 'logout');
    });

    Route::middleware('guest')->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');

        Route::get('/register', 'register');
        Route::post('/register', 'createUser');
    });
});
