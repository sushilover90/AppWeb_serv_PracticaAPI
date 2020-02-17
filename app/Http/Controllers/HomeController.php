<?php

namespace App\Http\Controllers;

use App\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $t = new HomeController();
        return view('home');
    }

    public function token(Request $request)
    {

        $token = Str::random(60);
        $hashed_token = hash('sha256', $token);

        $request->user()->forceFill([
            'api_token' => $hashed_token,
        ])->save();

        return view('token', ['token' => $hashed_token]);
    }

    public function borrarToken(Request $request)
    {
        $request->user()->forceFill([
            'api_token' => null,
        ])->save();

        return redirect('/home');
    }

    public function getToken(Request $request)
    {

        return view('getToken', ['token' => $request->user()->api_token]);
    }

    public function getRiotToken(Request $request)
    {

        $user_id = $request->user()->id;

        $token_actual = $request->user()->getTokens();

        return view(
            'riotToken',
            [
                'datos' => json_encode(
                    [
                        'user_id' => $user_id,
                        'token_actual' => $token_actual
                    ]
                )
            ]
        );
    }

    public function setRiotToken(Request $request)
    {
        if (!$request->data['token'] == '' && !$request->data['token'] == null) {
            $token = Token::createToken($request);

            $user_id = $request->user()->id;

            return Token::saveToken($token, $user_id, $request);
        }
        return response()->json(['error' => 'Token inválido o vacío.'], 409);
    }

    public function profile(Request $request)
    {


        $icon = LeagueAPI::getSummonerAvatar($request);

        $request->merge(['data' => ['summoner_name' => $request->segment(2)]]);

        $user = LeagueAPI::getSummonerInfo($request);

        $user = json_decode($user, true);

        $id = $user['id'];

        $accountId = $user['accountId'];

        $fav_champs = LeagueAPI::getChampionMastery($request, $id);

        $fav_champs = json_decode($fav_champs, true);

        $newfav_champs = [];

        for ($i = 0; $i < 3; $i++) {
            $key = $fav_champs[$i];
            $champ = LeagueAPI::getDDragon($key['championId']);
            $champ['championLevel'] = $key['championLevel'];
            $champ['championPoints'] = $key['championPoints'];
            $newfav_champs[] = $champ;
        }

        $ranked = LeagueAPI::getPositionRanked($request, $id);

        return view('profile', [
            'icon' => $icon,
            'fav' => json_encode($newfav_champs),
            'user' => json_encode($user),
            'ranked' => json_encode($ranked[0]),
        ]);
    }

    public function board(Request $request)
    {
        return view('board');
    }
}
