<?php

namespace App\Http\Controllers;

use App\Category;
use App\File;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Idea;
use Carbon\Carbon;
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

    public function ideas()
    {
        $pubIdeas = Idea::where('approve', 1)->orderBy('created_at', 'desc')->paginate(5);
        $draftIdeas = Idea::with('category')->where('approve', 0)->paginate(5);
//        dd($pubIdeas);
        return view('qamanager.allidea', compact('pubIdeas', 'draftIdeas'));
    }


    public function deleteCategory($id)
    {
        $check = Idea::where('cat_id', $id)->get();

        if ( !$check->isEmpty() ) {
            return redirect(route('addcat'))->with('warning', 'You can not delete this Category ! Its already in use');

        }
        $nCard = Category::find($id);
        $nCard->delete();
        return redirect(route('addcat'))->with('warning', 'Category Deleted');
    }

    public function addCategory(Request $request)
    {
        $category = new Category();
        $category->cat_name = $request['name'];
        $category->depart_id = $request['department'];
        $category->start_date = $request['datefrom'];
        $category->end_date = $request['dateto'];
        $category->final_end_date = $request['finaldate'];
        $category->save();

        return redirect('/qamanager/addcat')->with('status', 'Category added successfully');
    }

    public function ideasDownload()
    {
        return view('qamanager.download');
    }

    public function downloadZip($id){
//        dd($request->input('select'));
        $files = File::where('idea_id', $id)->get();
       // dd($files);
        $fileArr = [];

        foreach ($files as $file){
            $fileArr[] = glob(public_path("supporting/". $file->file));
        }
//        $files = glob(public_path("css/*"));
        $name = date('Ymd').rand(1, 100);
        \Zipper::make(public_path('downloaded/'. $name .'.zip'))->add($fileArr)->close();

//        return response()->download(public_path('test.zip'));
        return response()->download(public_path('downloaded/'.$name .'.zip'));

    }
}
