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
    // return view('welcome');
    return view('auth.login');
    
});

Route::get('/home', ['uses'=>'HomeController@index','as'=>'home','role'=>['student']])->name('home');
Route::get('/ahome', ['uses'=>'HomeController@index','as'=>'ahome','role'=>['admin']]);


Route::get('/qahome', function () {
    return view('qamanager.home');
});

Route::get('/stowncon', function () {
    return view('student.stowncon');
});

Route::get('/sthome', function () {
    return view('student.home');
});
Route::get('/stfhome', function () {
    return view('staff.home');
});

Route::get('/qacorhome', function () {
    return view('coordinator.home');
});
//Route::get('/ahome', function () {
//    return view('admin.home');
//})->name('index');

Route::post('/postComment', 'IdeaController@saveComment');

Route::group(['prefix' => 'student'], function () {
    Route::get('/login', 'StudentAuth\LoginController@showLoginForm')->name('slogin');
    Route::post('/login', 'StudentAuth\LoginController@login');
    Route::post('/logout', 'StudentAuth\LoginController@logout')->name('slogout');

    Route::get('/home', 'StudentController@index')->name('shome');
    Route::get('/contribution', 'StudentController@index')->name('sowncon');
    Route::post('/storeidea', 'IdeaController@saveIdea');

    Route::get('/register', 'StudentAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'StudentAuth\RegisterController@register');


    Route::post('/password/email', 'StudentAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'StudentAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'StudentAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'StudentAuth\ResetPasswordController@showResetForm');

});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('alogin');
    Route::post('/login', 'AdminAuth\LoginController@login');
    Route::post('/logout', 'AdminAuth\LoginController@logout')->name('alogout');

    Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'AdminAuth\RegisterController@register');

});

Route::group(['prefix' => 'staff'], function () {
    Route::get('/login', 'StaffAuth\LoginController@showLoginForm')->name('stlogin');
    Route::post('/login', 'StaffAuth\LoginController@login');
    Route::post('/logout', 'StaffAuth\LoginController@logout')->name('stlogout');


});

Route::group(['prefix' => 'qamanager'], function () {
    Route::get('/login', 'QamanagerAuth\LoginController@showLoginForm')->name('qlogin');
    Route::post('/login', 'QamanagerAuth\LoginController@login');
    Route::post('/logout', 'QamanagerAuth\LoginController@logout')->name('qlogout');

    Route::get('/home', 'QAManagerController@index')->name('qahome');

    Route::get('/statistics', function () {
        return view('qamanager.statistics');
    });
    Route::get('/statical2', function () {
        return view('qamanager.statical2');
    });
    Route::get('/addcat', function () {
        return view('qamanager.add_catagory');
    });
    Route::post('/addcat', 'QAManagerController@addCategory');

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

Route::group(['prefix' => 'coordinator'], function () {
    Route::get('/login', 'CoordinatorAuth\LoginController@showLoginForm')->name('clogin');
    Route::post('/login', 'CoordinatorAuth\LoginController@login');
    Route::post('/logout', 'CoordinatorAuth\LoginController@logout')->name('clogout');
    Route::post('/home', 'LoginController@logout')->name('chome');

    Route::post('/password/email', 'CoordinatorAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'CoordinatorAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'CoordinatorAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'CoordinatorAuth\ResetPasswordController@showResetForm');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
