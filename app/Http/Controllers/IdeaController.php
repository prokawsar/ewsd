<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\File;
use App\Idea;
use App\Comment;
use App\Like;
use App\Mail\CoorNotification;
use App\Mail\UserNotification;
use App\User;
use App\Visited;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class IdeaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }


    public function SaveIdeaLink(Request $request)
    {
        $idea = new Idea();
        $users_status = User::where('id', $request->user_id)->first();
//        dd($users_status);
        if($users_status->status) {
            if (is_null($request->anonym)) {
                $request->anonym = 0;
            } else {
                $idea->anonym = 1;
            }

            $idea->idea = $request->posts;
//        $idea->anonym = $request->anonym;
            $idea->cat_id = $request->category;
            $idea->student_id = $request->user_id;
            $idea->depart_id = $request->depart_id;
            $idea->save();

            $cord_id = Coordinator::select('cord_id')->where('depart_id', $request->depart_id)->first();
//            dd($cord_id);

            $email = User::select('email')->where('id', $cord_id->cord_id)->first();

            Mail::to($email->email)->send(new CoorNotification());

            $idea_id = Idea::select('id')->orderBy('created_at', 'desc')->first();

            if (isset($request->files)) {

                foreach ($request->files as $singleFile) {
                    foreach ($singleFile as $files) {
//                    dd($files);
                        $file = new File();
//                    $fileName = $files->getClientOriginalName() . '.' . $files->getClientOriginalExtension();
                        $fileName = $files->getClientOriginalName();
                        $files->move(public_path('supporting'), $fileName);

                        $file->file = $fileName;
                        $file->idea_id = $idea_id['id'];
                        $file->save();

                    }

                }

            }
            return redirect('/home')->with('status', 'Idea successfully submitted');
        }else{
            return redirect('/home')->with('warning', 'You are unable to submit idea ');
        }
    }

//    Save by ajax request
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

            if (isset($request->files)) {
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
        $userCheck = Idea::select('student_id')->where('id', $request->idea_id)->first();

        if ($userCheck->student_id != $request->user_id) {
//            checking if commenter is student
            $user = User::where('id', $request->user_id)->first();
            if ($user->hasRole('student')) {
                $email = User::select('email')->where('id', $userCheck->student_id)->first();
                Mail::to($email->email)->send(new UserNotification());
            }
        }

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
        $check = Like::where('idea_id', $request->idea_id)->where('user_id', $request->user_id)->first();

        if ($request->ajax()) {
            if (is_null($check)) {
                $like = new Like();
                $like->status = $request->value;
                $like->idea_id = $request->idea_id;
                $like->user_id = $request->user_id;
                $like->save();
            } else {
                // update status
                $check->status = $request->value;
                $check->save();

            }
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

    public function cancelIdea($id)
    {
        $idea = Idea::find($id);
        $idea->delete();

        return redirect(route('sideas'))->with('warning', 'Idea cancelled !');
    }

    public function deleteComment(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->delete();
    }

    public function singleIdea($id)
    {
        $check = Visited::where('idea_id', $id)->where('user_id', Auth::id())->first();
//        dd($check);
        if (is_null($check)) {
            $visited = new Visited();
            $visited->idea_id = $id;
            $visited->user_id = Auth::id();
            $visited->save();
        }

        $posts = Idea::with('user')->where('id', $id)->first();
        //    return json_encode($post);
        return view('student.singleIdea', compact('posts'));
    }
}
