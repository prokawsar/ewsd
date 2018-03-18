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
    if(Auth::user()){
        if( Auth::user()->hasRole('admin'))
        {
            return redirect(route('ahome'));
        }
        else if(Auth::user()->hasRole('coordinator')){

            return redirect(route('chome'));
        }
        else if(Auth::user()->hasRole('student')){

            return redirect(route('shome'));
        }
        else if(Auth::user()->hasRole('qamanager')){
            return redirect(route('qahome'));
        }
    }
    return view('auth.login');
    
});

Route::group(['middleware'=>'auth','role'=>['student']], function() {
    Route::get('/home', 'HomeController@index')->name('shome');
    Route::get('/myideas', 'HomeController@myIdeas')->name('sideas');
    Route::post('/storeidea', 'IdeaController@saveIdea');

    Route::get('/contribution', function () {
        return view('student.stowncon');
    })->name('sowncon');

});

Route::group(['middleware'=>'auth','role'=>['admin']], function() {
    Route::get('/admin/home', 'AdminController@index')->name('ahome');
    Route::get('/admin/ideas', 'AdminController@ideas')->name('ideas');

    Route::get('/ideaApprove{id}', ['uses'=>'AdminController@ideaApprove', 'role'=>['admin', 'coordinator']])->name('ideaApprove');
    Route::get('/ideaApprove{id}', ['uses'=>'AdminController@ideaApprove', 'role'=>['admin', 'coordinator']])->name('ideaApprove');
});

Route::group(['middleware'=>'auth','role'=>['qamanager']], function() {
    Route::get('/qamanager/home', 'QAManagerController@index')->name('qahome');
    Route::post('/qamanager/addcat', 'QAManagerController@addCategory');
    Route::get('/qamanager/delcat{id}', 'QAManagerController@deleteCategory')->name('delcat');

    Route::get('/qamanager/ideas', 'QAManagerController@ideas')->name('managerideas');

    Route::get('/qamanager/addcat', function () {
        return view('qamanager.add_catagory');
    })->name('addcat');

});

Route::group(['middleware'=>'auth','role'=>['coordinator']], function() {
    Route::get('/coordinator/home', 'QACoordinatorController@index')->name('chome');

    Route::get('/coordinator/ideas', 'QACoordinatorController@ideas')->name('coorideas');

    Route::get('/ideaIgnore{id}', ['uses'=>'QACoordinatorController@ideaIgnore', 'role'=>[ 'coordinator']])->name('ideaIgnore');

});

//Route::get('/home', ['uses'=>'HomeController@index','as'=>'home','role'=>['student']]);
//Route::get('/ahome', ['uses'=>'HomeController@index','as'=>'ahome','role'=>['admin']]);
Route::post('/postIdea', 'IdeaController@SaveIdeaLink');

Route::post('/postComment', 'IdeaController@saveComment');

Route::post('/like',['uses'=>'IdeaController@setLike','role'=>['coordinator', 'student', 'qamanager'],'as'=>'like']);
Route::post('/dislike',['uses'=>'IdeaController@setDislike','role'=>['coordinator', 'student', 'qamanager'],'as'=>'dislike']);


Route::group(['prefix' => 'qamanager'], function () {

    Route::get('/statistics', function () {
        return view('qamanager.statistics');
    });
    Route::get('/statical2', function () {
        return view('qamanager.statical2');
    });


    Route::get('/percentage', function () {
        return view('qamanager.percentage');
    });
//    Route::get('/ideas', function () {
//        return view('qamanager.ideas');
//    });
    Route::get('/contributors', function () {
        return view('qamanager.contributors');
    });
    Route::get('/contributor_idea', function () {
        return view('qamanager.contributor_idea');
    });
    Route::get('/idea_list', function () {
        return view('qamanager.idea_list');
    });
    Route::get('/ideas_catagory', function () {
        return view('qamanager.ideas_catagory');
    });
    Route::get('/catagorys_idea', function () {
        return view('qamanager.catagorys_idea');
    });
    Route::get('/liked_idea_details', function () {
        return view('qamanager.liked_idea_details');
    });
    Route::get('/commented_idea_details', function () {
        return view('qamanager.commented_idea_details');
    });
    Route::get('/idea_without_comment_details', function () {
        return view('qamanager.idea_without_comment_details');
    });
    Route::get('/idea_without_like_details', function () {
        return view('qamanager.idea_without_like_details');
    });
    Route::get('/liked_idea', function () {
        return view('qamanager.liked_idea');
    });
    Route::get('/commented_idea', function () {
        return view('qamanager.commented_idea');
    });
    Route::get('/idea_without_comment', function () {
        return view('qamanager.idea_without_comment');
    });
    Route::get('/idea_without_like', function () {
        return view('qamanager.idea_without_like');
    });


});

Auth::routes();
