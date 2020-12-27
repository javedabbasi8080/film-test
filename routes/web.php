<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', 'UserController@create');
Route::get('/login', 'UserController@login');

Route::get('/films', 'FilmController@index')->name('films');
Route::get('/films/add', 'FilmController@create')->name('films.add');
Route::get('/films/{name}', 'FilmController@show')->name('films.name');
