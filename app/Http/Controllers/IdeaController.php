<?php

namespace App\Http\Controllers;

use App\File;
use App\Idea;
use App\Comment;
use App\Like;
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
        if ($request->ajax()) {

            $idea = new Idea();
            $idea->idea = $request->ideas;
            $idea->anonym = $request->anonym;
            $idea->cat_id = $request->cat_id;
            $idea->student_id = $request->user_id;
            $idea->save();

            $idea_id = Idea::select('id')->orderBy('created_at', 'desc')->first();

            if(isset($request->files)){
                foreach ($request->files as $singleFile) {
                    $file = new File();
                    $fileName = time() . '.' . $singleFile->getClientOriginalExtension();
                    $singleFile->move(public_path('supporting'), $fileName);

                    $file->file = $fileName;
                    $file->idea_id = $idea_id['id'];
                    $file->save();

                }

            }
            return response()->json([
                'message' => 'Idea successfully submitted'
            ]);
        }
    }

    public function saveComment(Request $request)
    {
        //dd($request);
        if ($request->ajax()) {

            $comment = new Comment();
            $comment->comment = $request->comment;
            $comment->anonym = $request->anonym;
            $comment->idea_id = $request->idea_id;
            $comment->user_id = $request->user_id;
            $comment->save();

            return response()->json([
                'message' => 'Comment successful. '
            ]);
        }
    }


    public function setLike(Request $request)
    {
        if ($request->ajax()) {

            $like = new Like();
            $like->status = 1;
            $like->idea_id = $request->idea_id;
            $like->user_id = $request->user_id;
            $like->save();

            return response()->json([
                'message' => 'Like successful. '
            ]);
        }
    }


    public function setDislike(Request $request)
    {
        if ($request->ajax()) {

            $like = new Like();
            $like->status = 0;
            $like->idea_id = $request->idea_id;
            $like->user_id = $request->user_id;
            $like->save();

            return response()->json([
                'message' => 'Dislike successful. '
            ]);
        }

    }
}
