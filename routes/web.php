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
    // return view('welcome')
    return view('auth.login');
    
});
Route::group(['middleware'=>'auth','role'=>['student']], function() {
    Route::get('/home', 'HomeController@index')->name('shome');
    Route::post('/storeidea', 'IdeaController@saveIdea');

    Route::get('/contribution', function () {
        return view('student.stowncon');
    })->name('sowncon');

});

Route::group(['middleware'=>'auth','role'=>['admin']], function() {
    Route::get('/admin/home', 'AdminController@index')->name('ahome');
});

Route::group(['middleware'=>'auth','role'=>['qamanager']], function() {
    Route::get('/qamanager/home', 'QAManagerController@index')->name('qahome');
    Route::post('/qamanager/addcat', 'QAManagerController@addCategory');

});

Route::group(['middleware'=>'auth','role'=>['coordinator']], function() {
    Route::get('/coordinator/home', 'QACoordinatorController@index')->name('chome');
});

//Route::get('/home', ['uses'=>'HomeController@index','as'=>'home','role'=>['student']]);
//Route::get('/ahome', ['uses'=>'HomeController@index','as'=>'ahome','role'=>['admin']]);


Route::post('/postComment', 'IdeaController@saveComment');

Route::group(['prefix' => 'qamanager'], function () {

    Route::get('/statistics', function () {
        return view('qamanager.statistics');
    });
    Route::get('/statical2', function () {
        return view('qamanager.statical2');
    });
    Route::get('/addcat', function () {
        return view('qamanager.add_catagory');
    });

    Route::get('/percentage', function () {
        return view('qamanager.percentage');
    });
    Route::get('/ideas', function () {
        return view('qamanager.ideas');
    });
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
