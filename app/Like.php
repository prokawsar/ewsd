<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function idea()
    {
        return $this->belongsTo('App\Idea', 'idea_id');
    }
}
