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
Route::group(['middleware'=>['auth:api']],function (){

    Route::post('/summoner', 'LeagueAPI@getSummonerInfo');
    Route::get('/champion/by-summoner/{profileId}', 'LeagueAPI@getChampionMastery');
    Route::get('/DDragon/{champion_id}', 'LeagueAPI@getDDragon');
    Route::get('/RankedPos/{profile_id}', 'LeagueAPI@getPositionRanked');
    Route::post('/{profileName}', 'LeagueAPI@getSummonerAvatar');
    Route::get('/match/{accountId}', 'LeagueAPI@getMatchHistory');
    Route::get('/match-bygame/{gameid}', 'LeagueAPI@getMatchInfo');
    Route::get('/{profileName}','HomeController@profiledata');

});
