<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {

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
