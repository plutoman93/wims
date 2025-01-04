<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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

    // ออกจากระบบ
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
