<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Auth;

class AdminLoginController extends Controller
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
        // $this->middleware('guest')->except('logout'); // default
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }


    public function showLoginForm(){
        return view('auth.admin-login');
    }

    public function login(Request $request){

        // Validate the form data     
        $this->validate($request, [

            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        //Attempt to log the user in 
        // Auth::guard('admin')->attempt($credentials, $remember); // here attempt automatically hash the password
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password'=> $request->password], $request->remember)){

            //if successful , then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }

        //if unsuccessful, then redirect back to the login with the form data.
        //
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout( )
    {
        Auth::guard('admin')->logout();

        return redirect('/');
    }
}
