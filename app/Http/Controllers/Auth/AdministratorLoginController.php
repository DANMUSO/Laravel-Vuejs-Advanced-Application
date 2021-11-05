<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class AdministratorLoginController extends Controller
{
   
    public function __construct()
    {
    $this->middleware('guest:administrator', ['except'=> ['logout']]);
    }
    public function showLoginForm()
    {
        return view('auth.administrator-login');
    }
    public function login(Request $request)
    {
        //\Session::put('key', $request->email);
        //Validate the form data
        $this->validate($request,[
            'email'=> 'required|email',
            'password' => 'required|min:6'
            ]);
        //Attempt to log user in
       
        if(Auth::guard('administrator')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember))
        {
         //if successful, then redirect to their intended location.
         return view('/dashboard');
        }
        //if unsuccessful, then redirect to login form with the form data.
        return redirect()->back()->withInput($request->only('email','remember'));
    }
    public function logout()
    {
        Auth::guard('administrator')->logout();

        return redirect('/administrator/login');
    }
}
