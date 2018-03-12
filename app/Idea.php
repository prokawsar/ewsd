<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    public function user()
    {
        $this->hasOne('App\User');
    }
}
