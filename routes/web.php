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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']],function(){

    Route::post('/token/crear','HomeController@token');
    Route::post('/token/borrar','HomeController@borrarToken');
    Route::get('/board','HomeController@board');
    Route::post('/summoner','LeagueAPI@getSummonerInfo');
    Route::get('/token/get','HomeController@getToken');
    Route::get('/riottoken','HomeController@getRiotToken');
    Route::post('/riottoken','HomeController@setRiotToken');
    Route::get('/profile/{SummonerName}','HomeController@profile');
    #APIS
    Route::get('/profiledata/{sm}','HomeController@profiledata');
    Route::get('/api_token', 'HomeController@getTokenAsync');

});


