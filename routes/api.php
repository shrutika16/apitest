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
Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', 'Auth\LoginController@login')->name('login.api');
    Route::post('/register','Auth\RegisterController@register')->name('register.api');  
});

Route::group(['middleware' => 'auth:api'], function() {
    // our routes to be protected will go in here
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout.api');

    Route::post('/post/create', 'PostController@create_post')->name('post.create');
    Route::POST('/feedback/{action}', 'FeedbackController@process');

    Route::POST('/subscription/{action}', 'SubscriptionController@process');
});