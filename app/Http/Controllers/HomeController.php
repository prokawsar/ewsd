<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;

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
}
