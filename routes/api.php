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

Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');

Route::get('films', 'API\FilmController@index');


Route::group(['middleware' => 'auth:api'], function(){

	Route::get('logout', 'API\AuthController@logout');

	Route::post('film/store', 'API\FilmController@store');
	

	Route::get('', function(Request $request) {
	    dd($request->user());
	});

});
Route::get('films/{slug}', 'API\FilmController@show');

