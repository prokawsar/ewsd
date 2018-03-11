<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('student');
    }

    protected function guard()
    {
        return Auth::guard('student');
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
