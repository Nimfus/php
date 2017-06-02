<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('facebook', 'Auth\SocialAuthController@redirect');
Route::get('/callback', 'Auth\SocialAuthController@callback');

Route::get('/', ['name' => 'index', 'uses' => 'UserArea\UserAreaController@index']);

Route::group(['namespace' => 'Admin', 'prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', ['name' => 'dashboard', 'uses' => 'DashboardController@index']);
    Route::resource('users', 'UsersController');
    Route::resource('settings', 'SettingsController');
    Route::resource('plans', 'PlansController');
    Route::resource('coupons', 'CouponsController', ['only' => ['create', 'store', 'index', 'destroy']]);
    Route::resource('invoices', 'InvoicesController', ['only' => ['index', 'show']]);
    Route::resource('logs', 'LogsController', ['only' => ['show', 'index', 'destroy']]);
    Route::resource('posts', 'BlogController');
});

Route::group(['namespace' => 'UserArea', 'middleware' => 'auth'], function () {
    Route::get('profile', ['uses' => 'UserProfileController@edit', 'as' => 'profile']);
    Route::post('profile', ['uses' => 'UserProfileController@update', 'as' => 'profile']);

    /** Chat **/
    Route::get('messages/{threadId}', ['uses' => 'MessagesController@index']);
    Route::get('threads', ['uses' => 'ThreadsController@index']);
    Route::post('threads/{userId}', ['uses' => 'ThreadsController@store']);
    Route::post('messages/send', ['uses' => 'MessagesController@store']);

    /** Users manipulations **/
    Route::get('users/show', ['uses' => 'UsersController@show']);
    Route::get('users/{id}/like', ['uses' => 'UsersController@like']);
});
