<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use App\Champ;
use Symfony\Component\VarDumper\VarDumper;

class LeagueAPI extends Controller
{

    //Consigue toda la informacion acerca del perfil ingresado
    //Ingresas un String devuelve un JSON Object
    public static function getSummonerInfo(Request $request){

        $client = new Client(self::guzzleClientConfiguration());

        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/summoner/v4/summoners/by-name/".$request->data['summoner_name'], [
            'headers'  => [
                'X-Riot-Token' => self::getRiotToken($request)
            ]
        ]);

        $user = $response->getBody();

        if ($user != null){

            return $user;

        }
        return back();
    }

    public static function getSummonerAvatar(Request $request)
    {
        $url = "http://avatar.leagueoflegends.com/la1/";

        $url .= $request->segment(2);

        $url .= ".png";

        return $url;
    }

    public static function getDDragon($champId)
    {
        $client = new Client(self::guzzleClientConfiguration());

        $response = $client->request('GET', 'http://ddragon.leagueoflegends.com/cdn/10.3.1/data/es_MX/champion.json');

        $body = json_decode($response->getBody(), true);

        $data = $body['data'];

        foreach ($data as $key) {
            $id = $key['key'];
            if ($id == $champId) {
                $content = [
                    'name' => strtoupper($key['name']),
                    'title' => strtoupper($key['title']),
                    'details' => $key['blurb'],
                ];
                return $content;
            }
        }
    }

    public static function getChampionMastery(Request $request, String $id)
    {

        $client = new Client(self::guzzleClientConfiguration());

        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$id",[
            'headers'  => [
                'X-Riot-Token' => self::getRiotToken($request)
            ]
        ]);


        $champions = $response->getBody();

        return $champions;
    }

    public static function getPositionRanked(Request $request, String $id)
    {
        $client = new Client(self::guzzleClientConfiguration());

        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/league/v4/entries/by-summoner/$id",[
            'headers'  => [
                'X-Riot-Token' => self::getRiotToken($request)
            ]
        ] );

        $positionRanked = $response->getBody();

        $positionRanked = json_decode($positionRanked, true);


        if (empty($positionRanked)){

            return "Unranked";

        }

        return $positionRanked;

    }

    public static function getMatchHistory(Request $request, String $Accountid)
    {
        $client = new Client(self::guzzleClientConfiguration());

        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/match/v4/matchlists/by-account/$Accountid", [
            'headers'  => [
                'X-Riot-Token' => self::getRiotToken($request)
            ]
        ]);

        $Historial = $response->getBody();

        $Historial = json_decode($Historial, true);

        return $Historial;
    }

    private static function getRiotToken(Request &$request){

        return $request->user()->getTokens();

    }

    private static function guzzleClientConfiguration()
    {
        return [
            'base_url' => 'https://la1.api.riotgames.com',
            'timeout' => 5.0,
            'verify' => false
        ];
    }
}
