<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function Token()
    {
        return $this->hasMany(Token::class);
    }

    public function getTokens()
    {
        try{
            return $token = Token::getUserTokens($this->id,1)[0]->key;
        }catch (\ErrorException $e)
        {
            return $token[0] = 'No tienes un token riot registrado';
        }

    }

}
