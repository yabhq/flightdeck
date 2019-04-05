<?php

Route::group(['middleware' => ['api']], function () {

    /**
     * Login route
     */
    Route::post('login', '\Yab\FlightDeck\Http\Controllers\AuthController@store')->name('login');
    Route::post('logout', '\Yab\FlightDeck\Http\Controllers\AuthController@destroy')->name('logout');
    Route::post('refresh', '\Yab\FlightDeck\Http\Controllers\AuthController@update')->name('refresh');

    /**
     * Authenticated users
     */
    Route::group(['middleware' => ['auth']], function () {

        /**
         * Token refresh and user identification routes
         */
        Route::post('me', '\Yab\FlightDeck\Http\Controllers\UsersController@show')->name('me');
    });
});
