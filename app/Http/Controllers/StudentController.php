<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allIdeas = Idea::all();
        return view('student.home', compact(['allIdeas']));
    }


}
