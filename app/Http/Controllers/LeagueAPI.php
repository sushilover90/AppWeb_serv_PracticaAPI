<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use App\Champ;

class LeagueAPI extends Controller
{
    private static $token = "RGAPI-110e01bf-fdf8-4ffb-9eb4-e837f62b7fde";
    private static function header()
    {
        return [
            'headers'  => [
                'X-Riot-Token' => LeagueAPI::$token
            ]
        ];
    }

    //Consigue toda la informacion acerca del perfil ingresado
    //Ingresas un String devuelve un JSON Object
    public static function getSummonerInfo(String $SummonerName)
    {

        $client = new Client(self::guzzleClientConfiguration());

        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/summoner/v4/summoners/by-name/$SummonerName", self::header());

        $user = $response->getBody();
        $user = json_decode($user, true);
        return $user;
    }
    //Regresa una URL de la imagen de perfil de la cuenta
    public static function getSummonerAvatar(String $SummonerName)
    {
        $url = "http://avatar.leagueoflegends.com/la1/$SummonerName.png";
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

    public static function getChampionMastery(String $id)
    {

        $client = new Client(self::guzzleClientConfiguration());

        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$id", self::header());

        $champions = $response->getBody();

        return $champions;
    }

    public static function getOneChamp(string $id, int $champId)
    {

        $client = new Client(self::guzzleClientConfiguration());

        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/$id/by-champion/$champId", self::header());

        $champion = $response->getBody();

        $champion = json_decode($champion, true);

        return $champion;
    }

    //Consigue el posicionamiento en partidas igualadas del usuario
    public static function getPositionRanked(String $id)
    {
        $client = new Client(self::guzzleClientConfiguration());

        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/league/v4/entries/by-summoner/$id", self::header());

        $positionRanked = $response->getBody();

        if ($positionRanked != null){

            $positionRanked = json_decode($positionRanked, true);

            return $positionRanked;
        }
    }
    //Usar AccountID
    public static function getMatchHistory(String $Accountid)
    {
        $client = new Client(self::guzzleClientConfiguration());

        $response = $client->request('GET', "https://la1.api.riotgames.com/lol/match/v4/matchlists/by-account/$Accountid", self::header());

        $Historial = $response->getBody();

        $Historial = json_decode($Historial, true);

        return $Historial;
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
