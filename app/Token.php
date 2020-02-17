<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\New_;

class Token extends Model
{
    //
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Api()
    {
        return $this->belongsTo(Api::class);
    }

    public static function getUserTokens($user_id, $api_id)
    {
        return Token::where('user_id',$user_id)->where('active',1)->where('api_id',$api_id)->get();

    }

    public function setUserToken(Request &$request)
    {
        $this->key = $request->data['token'];
        $this->user_id = $request->user()->id;
        $this->api_id = 1;
    }

    public static function createToken(Request $request)
    {
        $token = New Token();

        $token->setUserToken($request);

        return $token;
    }

    public static function saveToken(Token &$token, &$user_id, Request &$request)
    {
        if(Token::deactiveTokens($user_id))
        {
            $token->save();
            return response()->json($request->user()->getTokens(),200);
        }
        if($token->save())
        {
            return response()->json($request->user()->getTokens(),200);
        }
        return response()->json(['error'=>'Error al registrar el token en el servidor, intente más tarde.'],409);
    }

    public static function deactiveTokens($user_id)
    {
        return Token::where('active',1)->where('api_id',1)->where('user_id',$user_id)->update(['active'=>0]);
    }
}
