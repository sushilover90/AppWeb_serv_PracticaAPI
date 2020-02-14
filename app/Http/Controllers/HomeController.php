<?php

namespace App\Http\Controllers;

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
        return view('home');
    }

    public function token(Request $request)
    {

        $token = Str::random(60);

        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return view('token',['token' => $token]);

    }

    public function borrarToken(Request $request)
    {
        $request->user()->forceFill([
            'api_token' => null,
        ])->save();

        return redirect('/home');
    }

    public function board()
    {
        return view('board');
    }

    public function summoner(Request $request)
    {
        return view('summoner',['summoner'=>LeagueAPI::getSummonerInfo($request->summoner_name)]);
    }

}
