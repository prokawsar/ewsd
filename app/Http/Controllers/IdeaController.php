<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function __construct()
    {
    }

    public function saveIdea(Request $request)
    {
        //dd($request);
        if($request->ajax()){

//            return $request->ideas;
            return response()->json([
                'message'=>'Idea successfully submitted'
            ]);
        }
    }
}
