<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $user = new User();

        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return back()->with('success', 'Register successfully');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = request([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/home-dashboard')->with('success', 'Login Success');
            // dd($request);
        }

        return back()->with('error', 'Error Email or Password');
    }

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.login');
    }
}
