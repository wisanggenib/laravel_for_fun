<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        dd($user);
    }

    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        // dd($request->input_company);
        $userModel = new User;
        $userModel->username = $request->input_username;
        $userModel->email = $request->input_email;
        $userModel->password = Hash::make($request->input_password);
        $userModel->address = $request->username;
        $userModel->company_name = $request->input_company;
        $userModel->address = "alamat";
        $userModel->role = 'member';
        $userModel->save();
        return redirect('/login');
    }

    //login
    public function login()
    {
        return view('login');
    }

    public function loginaction(Request $request)
    {
        $formCred = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($formCred)) {
            $request->session()->regenerate();
            return redirect('/home');
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Username or password was wrong!');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
