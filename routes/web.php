<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    if (Auth::user()) {
        if (Auth::user()->hasRole('admin')) {
            return redirect(route('ahome'));
        } else {
            if (Auth::user()->hasRole('coordinator')) {

                return redirect(route('chome'));
            } else {
                if (Auth::user()->hasRole('student')) {

                    return redirect(route('shome'));
                } else {
                    if (Auth::user()->hasRole('qamanager')) {
                        return redirect(route('qahome'));
                    }
                }
            }
        }
    }
    return view('auth.login');

});

Route::group(['middleware' => 'auth', 'role' => ['student']], function () {
    Route::get('/home', 'HomeController@index')->name('shome');
    Route::get('/myideas', 'HomeController@myIdeas')->name('sideas');
    Route::get('/categories', 'HomeController@categoryWise')->name('categories');
    Route::post('/storeidea', 'IdeaController@saveIdea');

    Route::get('/contribution', function () {
        return view('student.stowncon');
    })->name('sowncon');

});

Route::group(['middleware' => 'auth', 'role' => ['admin']], function () {
    Route::get('/admin/home', 'AdminController@index')->name('ahome');
    Route::get('/admin/ideas', 'AdminController@ideas')->name('ideas');
    Route::get('/admin/adddepart', function () {
        return view('admin.adddepart');
    })->name('adddepart');

    Route::post('/admin/adddepart', 'AdminController@addDepart')->name('adddept');
    Route::get('/admin/deldept{id}', 'AdminController@deleteDepart')->name('deldept');

    Route::get('/admin/student-details', 'AdminController@student')->name('sdetails');
    Route::get('/admin/staff-details', 'AdminController@staff')->name('stdetails');
    Route::get('/admin/addstudent', 'AdminController@addStudentForm')->name('addstudent');
    Route::post('/admin/addstudent', 'AdminController@addStudent')->name('addstudent');

    Route::get('/admin/addstaff', 'AdminController@addStaffForm')->name('addstaff');
    Route::post('/admin/addstaff', 'AdminController@addStaff')->name('addstaff');

    Route::get('/ideaApprove{id}',
        ['uses' => 'AdminController@ideaApprove', 'role' => ['qamanager', 'coordinator']])->name('ideaApprove');

});

Route::group(['middleware' => 'auth', 'role' => ['qamanager']], function () {
    Route::get('/qamanager/home', 'QAManagerController@index')->name('qahome');
    Route::post('/qamanager/addcat', 'QAManagerController@addCategory');
    Route::get('/qamanager/delcat{id}', 'QAManagerController@deleteCategory')->name('delcat');
    Route::get('/qamanager/editcat{id}', 'QAManagerController@editCategory')->name('editcat');

    Route::get('/qamanager/ideas', 'QAManagerController@ideas')->name('managerideas');
    Route::get('/qamanager/download', 'QAManagerController@ideasDownload')->name('ideasdownload');

    Route::get('/qamanager/downloadZIP{id}', 'QAManagerController@downloadZip')->name('downloadzip');

    Route::get('/qamanager/addcat', function () {
        return view('qamanager.add_catagory');
    })->name('addcat');

});

Route::group(['middleware' => 'auth', 'role' => ['coordinator']], function () {
    Route::get('/coordinator/home', 'QACoordinatorController@index')->name('chome');

    Route::get('/coordinator/ideas', 'QACoordinatorController@ideas')->name('coorideas');

    Route::get('/ideaIgnore{id}',
        ['uses' => 'QACoordinatorController@ideaIgnore', 'role' => ['coordinator']])->name('ideaIgnore');

});

//Route::get('/home', ['uses'=>'HomeController@index','as'=>'home','role'=>['student']]);
//Route::get('/ahome', ['uses'=>'HomeController@index','as'=>'ahome','role'=>['admin']]);
Route::post('/postIdea', 'IdeaController@SaveIdeaLink');

Route::post('/postComment', 'IdeaController@saveComment');
Route::post('/delcomment', 'IdeaController@deleteComment');

Route::post('/like',
    ['uses' => 'IdeaController@setLike', 'role' => ['admin', 'coordinator', 'student', 'qamanager'], 'as' => 'like']);
Route::post('/dislike',
    ['uses' => 'IdeaController@setDislike', 'role' => ['admin', 'coordinator', 'student', 'qamanager'], 'as' => 'dislike']);

Route::get('/category/{name}', 'HomeController@show');

Route::get('/posts/{id}/show', 'IdeaController@singleIdea')->name('singleIdea'); // I don't want to pass post id in link


Route::get('/report/departideas', ['uses' => 'AdminController@ideasDepart', 'role' => ['coordinator', 'admin', 'qamanager']])->name('ideasdepart');
Route::get('/report/departcont', 'AdminController@contDepart')->name('departcont');
Route::get('/report/departcat', 'AdminController@ideasCat')->name('departcat');
Route::get('/report/anonymous', 'AdminController@anonymous')->name('anonymous');
Route::get('/report/mostviewed', 'AdminController@mostViewed')->name('mostviewed');

Route::get('/report/mostliked', 'AdminController@mostLiked')->name('mostliked');
Route::get('/report/mostcommented', 'AdminController@mostCommented')->name('mostcommented');

Route::get('/report/withoutcomment', 'AdminController@withoutComment')->name('withoutcomment');


Auth::routes();
