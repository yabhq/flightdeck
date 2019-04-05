<?php

Route::group(['middleware' => ['auth']], function () {
	Route::post('me', '\Yab\FlightDeck\Http\Controllers\UsersController@show')->name('me');
});