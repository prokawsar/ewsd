<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\Idea;
use App\Qamanager;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Manager;

class AdminController extends Controller
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
        return view('admin.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ideas()
    {
        $pubIdeas = Idea::where('approve', 1)->paginate(5);
//        $draftIdeas = Idea::where('approve', 0)->paginate(5);
//        dd($draftIdeas);
        return view('admin.allidea', compact('pubIdeas'));
    }

    public function student()
    {
        $students = Student::with('user', 'department')->get();
//        dd($student);
        return view('admin.student', compact('students'));
    }

    public function addStudentForm()
    {
        return view('admin.addstudent');
    }


    public function addStudent(Request $request)
    {
        return view('admin.student', compact('students'));
    }

    public function addDepart(Request $request)
    {
        return redirect('/admin/adddepart')->with('status', 'Department Added');
    }


    public function deleteDepart($id)
    {
        return redirect('/admin/adddepart')->with('warning', 'Department Deleted');
    }

    public function staff()
    {
        $coordinators = Coordinator::with('user', 'department')->get();
        $managers = Qamanager::with('user')->get();
//        dd($coordinators);
        return view('admin.staff', compact('coordinators', 'managers'));
    }


    public function ideaApprove($id)
    {
        $idea = Idea::find($id);
        $idea->approve = 1;
        $idea->save();

//        return view('admin.allidea')->with('status', 'Idea Approved');
        return Redirect::back()->with('status', 'Idea Approved');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
