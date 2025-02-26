<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class MailController extends Controller
{
    public function sendEmailTasks()
    {
        // ดึงผู้ใช้ที่มีงาน และโหลดงานทั้งหมดของแต่ละคนมาพร้อมกัน
        $users = User::whereHas('tasks', function ($query) {
            $query->where('task_status_id', 2);
        })
            ->with(['tasks' => function ($query) {
                $query->where('task_status_id', 2);
            }])
            ->get();
            // dd($users->toArray());

        // วนลูปส่งอีเมลให้แต่ละผู้ใช้
        foreach ($users as $user) {
            $userTasks = $user->tasks; // ใช้ Eager Loading เพื่อดึงงานโดยตรง

            if ($userTasks->isNotEmpty()) {
                Mail::send('emails.task_status_update', [
                    'tasks' => $userTasks,
                    'Carbon' => Carbon::class
                ], function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('การอัปเดตสถานะงาน');
                });
                // dd($userTasks->count());
            }
        }

        return back()->with('success', 'ส่งอีเมลเรียบร้อยแล้ว');
    }
}
// 