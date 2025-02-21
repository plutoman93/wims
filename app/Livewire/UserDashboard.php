<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Component
{
    public $count, $countCompleted, $countUncompleted, $tasksData = [],$typeCountData =[];

    public function taskCount()
    {
        $userId = Auth::id(); // ดึง user_id ของผู้ใช้ที่ล็อกอินอยู่

        $this->count = Task::where('user_id', $userId)->count();
        $this->countCompleted = Task::where('user_id', $userId)->where('task_status_id', 1)->count();
        $this->countUncompleted = Task::where('user_id', $userId)->where('task_status_id', 2)->count();
    }

    public function mount()
    {
        $userId = Auth::id(); // ดึง user_id ของผู้ใช้ที่ล็อกอินอยู่

        $this->tasksData = [
            'labels' => ['งานทั้งหมด', 'งานที่เสร็จแล้ว', 'งานที่กำลังทำ'],
            'data' => [
                Task::where('user_id', $userId)->count(),
                Task::where('user_id', $userId)->where('task_status_id', 1)->count(),
                Task::where('user_id', $userId)->where('task_status_id', 2)->count()
            ]
        ];
    }

    public function countTasksByUser()
{

    $userId = Auth::id();

    $this->typeCountData = [
        'labels' => ['ปฏิบัติราชการ', 'ลากิจ', 'ประชุม'],
        'data' => [
            Task::where('user_id', $userId)->where('type_id',1)->count(),
            Task::where('user_id', $userId)->where('type_id', 2)->count(),
            Task::where('user_id', $userId)->where('type_id', 3)->count(),
            Task::where('user_id', $userId)->where('type_id', 4)->count(),

        ]
    ];
}

    public function render()
    {
        $this->taskCount();
        $this->countTasksByUser();

        return view('livewire.dashboard', [
            'count' => $this->count,
            'countCompleted' => $this->countCompleted,
            'countUncompleted' => $this->countUncompleted,
            'tasksData' => $this->tasksData,
            'typeCountData' => $this->typeCountData, // ข้อมูลจำนวนงานของแต่ละ user (ใช้ในกราฟแท่ง)
        ]);
    }
}
