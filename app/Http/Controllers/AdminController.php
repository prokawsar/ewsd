<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\Department;
use App\Idea;
use App\Mail\CoorNotification;
use App\Qamanager;
use App\Student;
use App\User;
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
        $pubIdeas = Idea::where('approve', 1)->orderBy('created_at', 'desc')->paginate(5);
        // return view('coordinator.home', compact('pubIdeas'));
        return view('admin.home', compact('pubIdeas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ideas()
    {
        $pubIdeas = Idea::where('approve', 1)->orderBy('created_at', 'desc')->paginate(5);
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

    public function addStaffForm()
    {
        return view('admin.addstaff');
    }


    public function addStudent(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = 2;
        $user->save();

        $user_id = User::select('id')->orderBy('created_at', 'desc')->first();

        $student = new Student();
        $student->student_id = $user_id->id;
        $student->depart_id = $request->department;
        $student->save();

        return redirect('/admin/addstudent')->with('status', 'Student Added');
    }


    public function addStaff(Request $request)
    {
        if(User::where('email', $request->email)->first()){
            return redirect('/admin/addstaff')->with('warning', 'Email already exist');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role;
        $user->save();

        $user_id = User::select('id')->orderBy('created_at', 'desc')->first();

        if($request->role == 3){
            $coordinator = new Coordinator();
            $coordinator->cord_id = $user_id->id;
            $coordinator->depart_id = $request->department; //no dhama chapa, real now
            $coordinator->save();
        }else {
            $manager = new Qamanager();
            $manager->qamanage_id = $user_id->id;
            $manager->save();
        }
        return redirect('/admin/addstaff')->with('status', 'New Staff Added');
    }

    public function addDepart(Request $request)
    {
        $depart = new Department();
        $depart->depart_name = $request->name;
        $depart->save();

        return redirect('/admin/adddepart')->with('status', 'Department Added');
    }


    public function deleteDepart($id)
    {
        if(Coordinator::where('depart_id', $id)->first() || Student::where('depart_id', $id)->first() ){

            return redirect('/admin/adddepart')->with('warning', 'Can not delete this Department');
        }

        Department::find($id)->delete();

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

    public function ideasDepart()
    {
        return view('admin.ideas_depart');
    }

    public function contDepart()
    {
        return view('admin.contri_depart');
    }

    public function ideasCat()
    {
        return view('admin.ideas_category');
    }

    public function anonymous()
    {
        return view('admin.anonym_idea_comment');
    }

    public function mostViewed()
    {
        return view('admin.most_viewed');
    }

    public function mostLiked()
    {
        return view('admin.liked_idea');
    }

    public function mostCommented()
    {
        return view('admin.commented_idea');
    }

    public function withoutComment()
    {
        return view('admin.without_like_comment');
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
