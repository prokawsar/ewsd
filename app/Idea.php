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

    public function file()
    {
        return $this->hasMany('App\File');
    }

    public function like()
    {
        return $this->hasMany('App\Like');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function visited()
    {
        return $this->hasMany('App\Visited');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'depart_id');
    }
}
