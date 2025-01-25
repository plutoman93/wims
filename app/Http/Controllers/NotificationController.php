<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TaskNotification;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    public function sendMail()
    {

        $data = [
            'name' => 'Anucha',
            'message' => 'นี่คือตัวอย่างข้อความที่ถูกส่งในอีเมล',
        ];

        Mail::to('arslan@dd.com')->send(new TaskNotification($data));

        return "ส่งอีเมลสำเร็จ!";
    }
}
