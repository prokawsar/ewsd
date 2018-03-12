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
        $allIdeas = Idea::all();
        return view('student.home', compact(['allIdeas']));
    }
}
