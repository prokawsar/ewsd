<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public $dates = ['start_date', 'end_date', 'final_end_date'];

    public function idea()
    {
        return $this->hasMany('App\Idea');
    }


    public function department()
    {
        return $this->belongsTo('App\Department', 'depart_id');
    }

    public static function post_count()
    {   // Need to get category id, name, number of post accociated with that category and order by name

        $total = DB::table('ideas')
            ->select(DB::raw('count(idea) as total, cat_name'))
            ->leftJoin('categories', 'categories.id', '=', 'ideas.cat_id')
            ->groupBy('cat_name')
            ->where('approve', 1)
            ->get();

        return $total;


    }
}
