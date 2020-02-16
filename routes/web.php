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

Route::post('/crear/token','HomeController@token')->middleware('auth');
Route::post('/borrar/token','HomeController@borrarToken')->middleware('auth');
Route::get('/board','HomeController@board')->middleware('auth');
Route::post('/summoner','HomeController@summoner')->middleware('auth');
Route::get('/profile/{SummonerName}','HomeController@profile');
