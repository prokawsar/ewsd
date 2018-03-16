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
        $allIdeas = Idea::where('approve', 1)->paginate(5);
        return view('student.home', compact(['allIdeas']));
    }

    public function myIdeas(){
        $allIdeas = Idea::where('approve', 1)->where('student_id', Auth::id())->paginate(5);
        $draftIdeas = Idea::where('approve', 0)->where('student_id', Auth::id())->paginate(5);

        return view('student.myideas', compact(['allIdeas', 'draftIdeas']));
    }
}
