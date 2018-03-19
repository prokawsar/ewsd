<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');

    }

    public function index(){
        $allIdeas = Idea::with('user')->where('approve', 1)->orderBy('created_at', 'desc')->paginate(5);
//        dd($allIdeas);
        return view('student.home', compact(['allIdeas']));
    }

    public function myIdeas(){
        $allIdeas = Idea::where('approve', 1)->where('student_id', Auth::id())->paginate(5);
        $draftIdeas = Idea::with('category')->where('approve', 0)->where('student_id', Auth::id())->paginate(5);

        return view('student.myideas', compact(['allIdeas', 'draftIdeas']));
    }
}
