<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
