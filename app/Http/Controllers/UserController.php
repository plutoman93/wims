<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckBanned;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function _construct()
    {
        $this->middleware(CheckBanned::class);
    }
    // กำหนดหน้าหลักตามสิทธิ์ของผู้ใช้
    public function index()
    {
        // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือยัง
        if (!Auth::check()) {
            return redirect()->route('login'); // หากยังไม่ได้ล็อกอิน
        }

        // ตรวจสอบสถานะผู้ใช้
        if (Auth::user()->status && Auth::user()->status->user_status_name === 'user') {
            return redirect()->route('dashboard'); // เส้นทางสำหรับ user
        } else {
            return view('admin-dashboard'); // เส้นทางสำหรับ admin
        }
    }

    // แสดงโปรไฟล์ผู้ใช้
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('user.profile', ['user' => $user]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/admin-dashboard')->with('success', 'Login Success');
            // dd($request);
        }

        return back()->with('error', 'Error Email or Password');
    }

    // ออกจากระบบ
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    /*
    * อัปเดตสถานะผู้ใช้
    *@param int $user_id
    *@param int $account_status_id
    *return Success
    *
    */
    public function updateStatus($user_id, $account_status_id)
    {
        $user = User::findOrFail($user_id);
        $user->account_status_id = $account_status_id;
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }
}
