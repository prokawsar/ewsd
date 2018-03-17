<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'student_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'cat_id');
    }
}
