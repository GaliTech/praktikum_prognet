<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function __construct()
    {
            $this->middleware('guest')->except('logout');
            $this->middleware('guest:admin')->except('logout');
            $this->middleware('guest:user')->except('logout');
    }

     public function showAdminLoginForm()
    {
        return view('auth.loginAdmin');
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required|string',
            'password' => 'required|string|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/dashboard');
        }else {
            return redirect()->back()->withInput($request->only('username','remember'));
        }
    }


    //User Login
     public function showUserLoginForm()
    {
        return view('auth.login');
    }

    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            //redirect jika sukses login
            // dd('Berhasil');
            // return view('beranda');
            return redirect()->intended('/user');
        }else {
             //redirect jika gagal login
            return redirect()->back()->withInput($request->only('email','remember'));
        }
    }   
}