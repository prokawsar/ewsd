<?php

namespace App\Http\Controllers;

use App\Idea;
use App\Comment;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function saveIdea(Request $request)
    {
        //dd($request);
        if($request->ajax()){

            $idea = new Idea();
            $idea->idea = $request->ideas;
            $idea->cat_id = $request->cat_id;
            $idea->student_id = $request->user_id;
            $idea->save();

            return response()->json([
                'message'=>'Idea successfully submitted'
            ]);
        }
    }

    public function saveComment(Request $request)
    {
        //dd($request);
        if($request->ajax()){

            $comment = new Comment();
            $comment->comment = $request->comment;
            $comment->idea_id = $request->idea_id;
            $comment->user_id = $request->user_id;
            $comment->save();

            return response()->json([
                'message'=>'Comment successful. '
            ]);
        }
    }
}
