<?php

use Illuminate\Http\Request;

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

Route::group(["middleware" => "api"], function () {
    Route::post('/login', 'Auth\LoginController@login');
    Route::middleware(['auth'])->group(function () {
        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
        Route::get('/current_admin_user', function () {
            return Auth::user();
        })->name('current_admin_user');
        Route::group(['namespace' => 'Api'], function () {
            Route::apiResource('admins', 'AdminUserController');
            Route::group(['namespace' => 'Admin'], function () {
                Route::apiResource('users', 'UserController');
            });
        });
    });
});
