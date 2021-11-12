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

    public function index()
    {
        if(Auth::check()){
            return view('admin.index', ['user' => Auth::user()]);
        }
  
        return redirect("admin/login")->withSuccess('You are not allowed to access');
    }  
    
    
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin')
                        ->withSuccess('Signed in');
        }
  
        return redirect("admin/login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('admin.auth.registration');
    }
      

    public function register(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("admin")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }      

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('admin/login');
    }
}
