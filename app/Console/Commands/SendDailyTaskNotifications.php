<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\MailNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendDailyTaskNotifications extends Command
{
    protected $signature = 'notifications:send-daily-tasks';
    protected $description = 'Send daily task notifications';

    public function handle()
    {
        try {
            $tasks = Task::with('user')->get();

            foreach ($tasks as $task) {
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
        } catch (\Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
            Log::error("An error occurred: " . $e->getMessage());
        }
    }
}
