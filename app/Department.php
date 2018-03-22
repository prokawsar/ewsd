<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function category()
    {
        return $this->hasMany('App\Category' );
    }

    public function idea()
    {
        return $this->hasMany('App\Idea');
    }
}
