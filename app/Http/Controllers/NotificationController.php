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

            foreach ($chunks as $chunk) {
                foreach ($chunk as $task) {
                    $user = $task->user;

                    if ($user) {
                        try {
                            $user->notify(new MailNotification($task));
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

                sleep(60);
            }
        } catch (\Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
            Log::error("An error occurred: " . $e->getMessage());
        }

        return view('emails.example');
    }
    public function error()
    {
        // โค้ดที่ต้องการให้ทำงานเมื่อเกิด error
        return redirect()->back();
        // return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการส่งอีเมล');
    }
}
