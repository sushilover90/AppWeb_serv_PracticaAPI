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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>['auth:api']],function (){
    Route::match(['post','get'],'/summoner/{SummonerName}', 'LeagueAPI@getSummonerInfo');
    Route::post('/champion/by-summoner/{id}', 'LeagueAPI@getChampionMastery');
    Route::get('/champion/by-summoner/{id}', 'LeagueAPI@getChampionMastery');
    Route::get('/champion-image/{id}', 'LeagueAPI@getChampImage');
    Route::get('/DDragon/{id}', 'LeagueAPI@getDDragon');
    Route::get('/RankedPos/{id}', 'LeagueAPI@getPositionRanked');
    Route::post('/{name}', 'LeagueAPI@getSummonerAvatar');
});
