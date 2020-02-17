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

        return view('token',['token' => $hashed_token]);

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

        return view('getToken',['token'=>$request->user()->api_token]);

    }

    public function getRiotToken(Request $request)
    {

        $user_id = $request->user()->id;

        $token_actual = $request->user()->getTokens();

        return view('riotToken',
            ['datos'=>json_encode(
                ['user_id'=>$user_id,
                    'token_actual'=>$token_actual
                ])
            ]
        );
    }

    public function setRiotToken(Request $request)
    {

        //RGAPI-ec4280b8-c049-400b-886f-3056f15aa57c

        $token_check = str_split($request->data['token']);
        $token_start = ['R','G','A','P','I','-'];

        for($i = 0;$i<6;$i++)
        {
            if(!($token_check[$i]===$token_start[$i]))
            {
                return response()->json(['error'=>'Token invalido o vacio'],409);
            }
        }

        if(!$request->data['token']==''&&!$request->data['token']==null) {
            $token = Token::createToken($request);

            $user_id = $request->user()->id;

            return Token::saveToken($token, $user_id, $request);
        }
        return response()->json(['error'=>'Token inválido o vacío.'],409);

    }

    public function profile(Request $request){

        $icon = LeagueAPI::getSummonerAvatar($request);
        $request->merge(['data'=>['summoner_name'=>$request->segment(2)]]);
        $user = LeagueAPI::getSummonerInfo($request);
        $user = json_decode($user,true);
        $id = $user['id'];

        return view('profile', ['icon' => $icon, 'fav' => LeagueAPI::getChampionMastery($request, $id)]);
    }

    public function board(Request $request)
    {
        return view('board');
    }

}
