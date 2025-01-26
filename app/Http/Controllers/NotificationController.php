<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use App\Models\Task;
use App\Models\User;
use App\Notifications\MailNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendMail(Request $request)
    {
        // ตรวจสอบว่าค่าที่ส่งมานั้นไม่เป็น null
        $request->validate([
            'task_id' => 'required|integer',
        ]);

        // ดึงข้อมูล task จากฐานข้อมูล
        $task = Task::find($request->task_id);

        if (!$task) {
            return response()->json(['error' => 'ไม่พบ task ที่ระบุ'], 404);
        }

        // ดึงข้อมูลเจ้าของงาน
        $owner = User::find($task->user_id);

        if (!$owner) {
            return response()->json(['error' => 'ไม่พบเจ้าของงานที่ระบุ'], 404);
        }

        // ส่งอีเมลไปยังเจ้าของงาน
        Notification::route('mail', $owner->email)->notify(new MailNotification($task));

        return response()->json(['success' => 'ส่งอีเมลสำเร็จ!']);
    }

}
