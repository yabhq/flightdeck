<?php

Route::group(['middleware' => ['auth']], function () {
	Route::post('me', '\Yab\FlightDeck\Controllers\UsersController@show');
});