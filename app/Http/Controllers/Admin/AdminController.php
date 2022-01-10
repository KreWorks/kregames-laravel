<?php

namespace App\Http\Controllers\Admin;

use Hash;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class AdminController extends BaseController
{
    //https://www.positronx.io/laravel-custom-authentication-login-and-registration-tutorial/

    //protected $page = 'admin';
    protected $page = 'apa';

    public function __construct()
    {
        $this->middleware('guest')->except(['index', 'logout']);
    }

    public function index()
    {
        if(!Auth::check()) {
            return redirect("admin/login");
        }

        $data = [
            'controller' => 'Admin',
            'action' => 'Dashboard',
        ];


        return view($this->page.'.index', $data);
    }


    public function login()
    {
        return view($this->page.'.login');
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
