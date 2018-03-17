<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $dates = ['start_date', 'end_date', 'final_end_date'];

    public function idea()
    {
        return $this->hasMany('App\Idea');
    }
}
