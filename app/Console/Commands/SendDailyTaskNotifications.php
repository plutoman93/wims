<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\MailNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection; // Import Collection

class SendDailyTaskNotifications extends Command
{
    protected $signature = 'notifications:send-daily-tasks';
    protected $description = 'Send daily task notifications';

    public function handle()
    {
        try {
            $tasks = Task::with('user')->get();

            // แบ่ง Task ออกเป็นชุดๆ (batch)
            $chunks = $tasks->chunk(10); // แบ่งเป็นชุด Task (ปรับได้ตามความเหมาะสม)

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

                sleep(5); // เว้นระยะ วินาที หลังจากการส่งแต่ละชุด (ปรับได้ตามความเหมาะสม)
            }
        } catch (\Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
            Log::error("An error occurred: " . $e->getMessage());
        }
    }
}
