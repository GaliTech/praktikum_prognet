<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // use RegistersUsers;
    //  * @var string
    //  */
    // // protected $redirectTo = '/home';
    public function showForm()
    {
        return view('auth.register');
    }


    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }




    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    //     $this->middleware('guest:admin');
    //     $this->middleware('guest:user');
    // }    
    
 /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));

        event(new Registered($user));

        // return redirect(RouteServiceProvider::HOME);

        
        return redirect()->intended('/verify-email');
        // return view('auth.verify-email');
        // return redirect()->intended('verification-verify');
        // return redirect('/verify-email');
    }
}