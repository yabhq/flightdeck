<?php

/**
 * Getting ready for takeoff...
 */
Route::group(['middleware' => ['api', 'cors'], 'namespace' => 'Yab\FlightDeck\Http\Controllers'], function () {

    /**
     * JWT token routes
     */
    Route::post('login', 'AuthController@store')->name('login');
    Route::post('logout', 'AuthController@destroy')->name('logout');
    Route::post('refresh', 'AuthController@update')->name('refresh');

    /**
     * Forgot password
     */
    Route::post('password/email', 'ForgotPasswordController@sendResetEmail')->name('password.email');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset');

    /**
     * Authenticated users
     */
    Route::group(['middleware' => ['auth']], function () {

        /**
         * Users
         */
        Route::post('me', 'UsersController@show')->name('me');
    });
});
