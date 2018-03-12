<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
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
}
