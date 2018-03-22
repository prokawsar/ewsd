<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visited extends Model
{
    public function idea()
    {
        return $this->belongsTo('App\Idea');
    }
}
