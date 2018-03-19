<?php

namespace App\Http\Controllers;

use App\Idea;
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
        return view('coordinator.home');
    }

    public function ideas()
    {
        $pubIdeas = Idea::where('approve', 1)->orderBy('created_at', 'desc')->paginate(5);
        $draftIdeas = Idea::with('category')->where('approve', 0)->paginate(5);
//        dd($pubIdeas);
        return view('coordinator.allidea', compact('pubIdeas', 'draftIdeas'));
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
