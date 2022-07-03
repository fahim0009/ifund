<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Redirect;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'logemail' => 'required|email',
            'logpassword' => 'required',
        ]);

        $user = User::where('email',  $input['logemail'])->first();

        if(empty($user)){
            return Redirect::back()->withErrors(
                [
                    'logemail' => 'Email does not match!!',
                ]
            );
        }

        if(auth()->attempt(array('email' => $input['logemail'], 'password' => $input['logpassword'])))
        {
            if (auth()->user()->is_type == 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if (auth()->user()->is_type == 'staff') {
                return redirect()->route('admin.dashboard');
            }
            if (auth()->user()->is_type == 'user') {
                return redirect()->route('fundraiser.profile');
            }
            if (auth()->user()->is_type == 0) {
                return redirect()->route('home');
            }

            
        }else{

            return Redirect::back()->withErrors(
                [
                    // 'logemail' => 'Email Error!!',
                    'logpassword' => 'Password does not match!!'
                ]
            );
        }
    }
}
