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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/token/crear','HomeController@token')->middleware('auth');
Route::post('/token/borrar','HomeController@borrarToken')->middleware('auth');
Route::get('/board','HomeController@board')->middleware('auth');
Route::post('/summoner','LeagueAPI@getSummonerInfo')->middleware('auth');
Route::get('/token/get','HomeController@getToken')->middleware('auth');
Route::get('/riottoken','HomeController@getRiotToken')->middleware('auth');
Route::post('/riottoken','HomeController@setRiotToken')->middleware('auth');
Route::get('/profile/{SummonerName}','HomeController@profile');
Route::get('/prueba/{texto}','HomeController@prueba')->middleware('auth');
