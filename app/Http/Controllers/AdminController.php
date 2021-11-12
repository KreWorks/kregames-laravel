<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //https://www.positronx.io/laravel-custom-authentication-login-and-registration-tutorial/
    /*public function index()
    {
        return view('admin.index');
    }
*/
    //
    public function login()
    {
        return view('admin.login');
    }

     /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        echo 'itt vagyok';
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        var_dump($credentials);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            die('here i come');
            return redirect()->intended('admin');
        }
        die('here we are');
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    //From web 
    public function index()
    {
        return view('admin.auth.login');
    }  
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("admin/login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('admin.auth.registration');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("admin/dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('admin.dashboard');
        }
  
        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('admin/login');
    }
}
