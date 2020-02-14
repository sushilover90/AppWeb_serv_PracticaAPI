<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class LeagueAPI extends Controller
{
    private static $token = "RGAPI-c7175ccb-ecee-4f41-9a42-5cdfb4e905c2";   //Mi token, deben cambiarlo si expira

    //Consigue toda la informacion acerca del perfil ingresado 
    //Ingresas un String devuelve un JSON Object
    public static function getSummonerInfo(String $SummonerName){

        $client = new Client([

            'base_url' => 'https://la1.api.riotgames.com',
            'timeout' => 5.0

        ]);
        
        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/summoner/v4/summoners/by-name/$SummonerName", [
            'headers'  => [
                'X-Riot-Token' => LeagueAPI::$token
            ]
        ]);

        $user = $response->getBody();
        $user = json_decode($user, true);
        return $user;

    }
    //Regresa una URL de la imagen de perfil de la cuenta
    public static function getSummonerAvatar(String $SummonerName){
        $url = "http://avatar.leagueoflegends.com/la1/$SummonerName.png";
        return $url;
    }
    //Consigue las estadisticas de los campeones jugados
    //por el usuario
    //Ingresa un INT regresa un JSON Array>Object
    public static function getChampionMastery(int $id){

        $client = new Client([
            'base_url' => 'https://la1.api.riotgames.com',
            'timeout' => 5.0
        ]);
        
        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$id", [
            'headers'  => [
                'X-Riot-Token' => LeagueAPI::$token
            ]
        ]);

        $champions = $response->getBody();
        
        $champions = json_decode($champions, true);

        return $champions;
    }
    //Consigue las estadisticas de un campeon especifico jugado
    //por el usuario
    //Ingresa un INT y STRING regresa un Object
    public static function getOneChamp(string $id, int $champId){
        $client = new Client([
            'base_url' => 'https://la1.api.riotgames.com',
            'timeout' => 5.0
        ]);
        
        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$id/by-champion/$champId", [
            'headers'  => [
                'X-Riot-Token' => LeagueAPI::$token
            ]
        ]);

        $champion = $response->getBody();
        
        $champion = json_decode($champion, true);

        return $champion;
    }

    //Consigue el posicionamiento en partidas igualadas del usuario
    public static function getPositionRanked(String $id){
        $client = new Client([
            'base_url' => 'https://la1.api.riotgames.com',
            'timeout' => 5.0
        ]);
        
        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/league/v4/entries/by-summoner/$id", [
            'headers'  => [
                'X-Riot-Token' => LeagueAPI::$token
            ]
        ]);

        $positionRanked = $response->getBody();

        $positionRanked = json_decode($positionRanked, true);

        return $positionRanked;
    }
    //Usar AccountID
    public static function getMatchHistory(String $Accountid){
        $client = new Client([
            'base_url' => 'https://la1.api.riotgames.com',
            'timeout' => 5.0
        ]);
        
        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/match/v4/matchlists/by-account/$Accountid", [
            'headers'  => [
                'X-Riot-Token' => LeagueAPI::$token
            ]
        ]);

        $Historial = $response->getBody();

        $Historial = json_decode($Historial, true);

        return $Historial;

    }
}
