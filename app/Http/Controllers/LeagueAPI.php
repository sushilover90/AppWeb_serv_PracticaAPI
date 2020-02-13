<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class LeagueAPI extends Controller
{
    public $token = "RGAPI-c7175ccb-ecee-4f41-9a42-5cdfb4e905c2";   //Mi token, deben cambiarlo si expira

    public function getSummonerInfo($SummonerName){

        $client = new Client([

            'base_url' => 'https://la1.api.riotgames.com',
            'timeout' => 5.0

        ]);
        
        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/summoner/v4/summoners/by-name/$SummonerName", [
            'headers'  => [
                'X-Riot-Token' => $this->token
            ]
        ]);

        $user = $response->getBody();
        $user = json_decode($user, true);
        return $user;

    }

    public function getChampionMastery($id){

        $client = new Client([
            'base_url' => 'https://la1.api.riotgames.com',
            'timeout' => 5.0
        ]);
        
        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$id", [
            'headers'  => [
                'X-Riot-Token' => $this->token
            ]
        ]);

        $champions = $response->getBody();
        
        $champions = json_decode($champions, true);

        return $champions;
    }
}
