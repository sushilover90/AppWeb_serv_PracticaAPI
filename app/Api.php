<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Api extends Model
{
    //
    public function Token()
    {
        return $this->hasMany(Token::class);
    }

}
