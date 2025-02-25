<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class MailController extends Controller
{
    public function sendEmailTasks()
    {
        // ดึงผู้ใช้ทั้งหมด
        $users = User::all();

        // ส่งอีเมลไปยังผู้ใช้ที่มีงานที่สถานะ task_status_id = 2
        foreach ($users as $user) {
            // ดึงงานที่เจ้าของงานคือ $user->id และสถานะ task_status_id = 2
            $tasks = Task::where('user_id', $user->user_id)
                ->where('task_status_id', 2)
                ->get();

            // ส่งอีเมลเฉพาะถ้ามีงาน
            if ($tasks->isNotEmpty()) {
                Mail::send('emails.task_status_update', ['tasks' => $tasks, 'Carbon' => Carbon::class], function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('การอัปเดตสถานะงาน');
                });
            }
        }

        return back()->with('success', 'ส่งอีเมลเรียบร้อยแล้ว');
    }
}
