<?php

namespace App\Http\Controllers\QamanagerAuth;

use App\Http\Controllers\Controller;
use App\Qamanager;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;
use Illuminate\Support\Facades\Hash;

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

    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/qamanager/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('qamanager.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('qamanager.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('qamanager');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
//        where('password', Hash::check($request->password))->first();
        $qamanager = Qamanager::where('qamanage_id', $user->id)->get();


        if (isset($qamanager[0]->id)) {

//            dd($user);
            if (Auth::guard('qamanager') && Hash::check($request->password, $user->password)) {

                Auth::guard('qamanager')->login($user);
//                dd($user);
                return redirect(route('qahome'));

            }
        }
        return redirect(route('qlogin'))
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => "Problem with email or password !!",
            ]);

    }
}
