<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['idea_id', 'file'];

    public function idea()
    {
        return $this->belongsTo('App\Idea');
    }
}
