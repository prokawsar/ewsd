<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;

class QAManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function index()
    {
        return view('qamanager.home');
    }

    public function addCategory(Request $request)
    {
        $category = new Category();
        $category->cat_name = $request['name'];
        $category->start_date = $request['datefrom'];
        $category->end_date = $request['dateto'];
        $category->final_end_date = $request['finaldate'];
        $category->save();

        return redirect('/qamanager/addcat')->with('status', 'Category added successfully');
    }
}
