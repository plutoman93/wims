<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Task;
use App\Mail\TaskNotification;
use Illuminate\Support\Facades\Mail;

class SendDailyTaskNotifications extends Command
{
    // protected $signature = 'send:daily-task-notifications';
    // protected $description = 'Send daily task notifications to all users';

    // public function __construct()
    // {
    //     parent::__construct();
    // }

    // public function handle()
    // {
    //     $users = User::all();

    //     foreach ($users as $user) {
    //         $tasks = Task::where('user_id', $user->id)
    //             ->whereDate('due_date', now()->toDateString()) // เลือก task วันนี้
    //             ->get();

    //         if ($tasks->isNotEmpty()) {
    //             Mail::to($user->email)->send(new TaskNotification($user, $tasks));
    //         }
    //     }

    //     $this->info('Daily task notifications sent successfully!');
    // }
}
