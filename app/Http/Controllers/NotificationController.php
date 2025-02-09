<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use App\Models\Task;
use App\Notifications\MailNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendMail(Request $request)
    {
        try {
            // ดึงงานที่มี task_status_id เท่ากับ 2 เท่านั้น
            $tasks = Task::with('user')->where('task_status_id', 2)->get();

            // แบ่ง Task ออกเป็นชุดๆ (batch)
            $chunks = $tasks->chunk(5); // แบ่งเป็นชุด Task (ปรับได้ตามความเหมาะสม)

            foreach ($chunks as $chunk) { // วนลูปแต่ละชุด Task
                foreach ($chunk as $task) {
                    $user = $task->user; // ดึงข้อมูลผู้ใช้ที่ถูกมอบหมายงาน

                    if ($user) { // ตรวจสอบว่ามีผู้ใช้ที่ถูกมอบหมายงานหรือไม่
                        try {
                            $user->notify(new MailNotification($task)); // ส่ง Notification ไปยังผู้ใช้
                            $this->info("Notification sent to {$user->email} for task: {$task->task_name}");
                            Log::info("Notification sent to {$user->email} for task: {$task->task_name}");
                        } catch (\Exception $e) {
                            $this->error("Failed to send notification to {$user->email} for task: {$task->task_name}. Error: " . $e->getMessage());
                            Log::error("Failed to send notification to {$user->email} for task: {$task->task_name}. Error: " . $e->getMessage());
                        }
                    } else {
                        $this->warn("Task {$task->id} has no assigned user.");
                        Log::warning("Task {$task->id} has no assigned user.");
                    }
                }

                // sleep(30); // หยุดระหว่างการส่ง Notification ชุดนี้กับชุดถัดไป (ปรับได้ตามความเหมาะสม)
            }
        } catch (\Exception $e) { // จัดการ error ที่เกิดขึ้น
            $this->error("An error occurred: " . $e->getMessage()); // แสดง error message ใน console
            Log::error("An error occurred: " . $e->getMessage());
        }

        return view('emails.email')->with('success', 'ส่งเมล์สำเร็จ!'); // ส่งผลลัพธ์กลับไปยัง view 
    }
    public function error()
    {
        // โค้ดที่ต้องการให้ทำงานเมื่อเกิด error
        return redirect('email')->with('error', 'เกิดข้อผิดพลาด!'); // ส่งผลลัพธ์กลับไปยัง view
    }
}
