<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type == 'user') {
            return redirect()->route('dashboard'); // เปลี่ยนไปที่ dashboard สำหรับ user
        } else {
            return view('admin-dashboard'); // เปลี่ยนไปที่ admin-dashboard สำหรับ admin
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.login');
    }
}
