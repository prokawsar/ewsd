<?php

namespace App\Http\Controllers;

use App\Idea;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QACoordinatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function index()
    
    {
        $pubIdeas = Idea::where('approve', 1)->orderBy('created_at', 'desc')->paginate(5);
        return view('coordinator.home', compact('pubIdeas'));
    }

    public function ideas()
    {
        $pubIdeas = Idea::where('approve', 1)->orderBy('created_at', 'desc')->paginate(5);
        $draftIdeas = Idea::with('category')->where('approve', 0)->orderBy('created_at', 'desc')->paginate(5);
//        dd($pubIdeas);
        return view('coordinator.allidea', compact('pubIdeas', 'draftIdeas'));
    }

    public function disableAccount($id, $post_id)
    {
        $user = User::where('id', $id)->first();
        $user->status = 0;
        $user->save();

        $idea = Idea::where('id', $post_id)->first();
        $idea->delete();

        return redirect(route('chome'))->with('warning', 'Student Account disabled');
    }

    public function enableAccount($id)
    {
        $user = User::where('id', $id)->first();
        $user->status = 1;
        $user->save();

        return redirect(route('chome'))->with('warning', 'Student Account Enabled');
    }

    public function ideaIgnore($id)
    {
        $idea = Idea::find($id);
        $idea->approve = -1;
        $idea->save();

//        return view('admin.allidea')->with('status', 'Idea Approved');
        return Redirect::back()->with('warning', 'Idea Ignored');
    }

}
