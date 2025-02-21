<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Component
{
    public $count, $countCompleted, $countUncompleted, $tasksData = [], $typeCountData = [], $labels = [], $data = [], $users = [];
    public $tasktype1, $tasktype2, $tasktype3;
    public function taskCount()
    {
        $this->count = Task::count();
        $this->countCompleted = Task::where('task_status_id', 1)->count();
        $this->countUncompleted = Task::where('task_status_id', 2)->count();
    }

    public function taskTpyeCount()
    {
        $this->tasktype1 = Task::where('type_id', 1)->count();
        $this->tasktype2 = Task::where('type_id', 2)->count();
        $this->tasktype3 = Task::where('type_id', 3)->count();
    }

    public function countTasksByUser()
{
    $users = User::all();

    $this->typeCountData = [
        'labels' => [User::find(1)->first_name, User::find(2)->first_name, User::find(3)->first_name,],
        'data' => [
            Task::where('user_id', Auth::id())->count(),
            Task::where('user_id', 2)->count(),
            Task::where('user_id', 3)->count(),
            Task::where('user_id', 4)->count(),

        ]
    ];
}

    public function mount()
    {
        $this->tasksData = [
            'labels' => ['งานทั้งหมด', 'งานที่เสร็จแล้ว', 'งานที่กำลังทำ'],
            'data' => [
                Task::count(),
                Task::where('task_status_id', 1)->count(),
                Task::where('task_status_id', 2)->count(),
            ]
        ];

    }

    public function taskUserCount()
    {
        // ดึง users และนับจำนวน tasks ของแต่ละ user
        $this->users = User::withCount('tasks')->get();
    }

    public function render()
    {
        // เรียกใช้ taskCount() เพื่ออัปเดตค่าต่างๆ เกี่ยวกับจำนวนงาน
        $this->taskCount();
        $this->countTasksByUser();
        $this->taskTpyeCount();


        return view('livewire.admin-dashboard', [
            'count' => $this->count, // ส่งตัวแปร count ไปที่ view
            'countCompleted' => $this->countCompleted, // ส่งจำนวนงานที่เสร็จแล้ว
            'countUncompleted' => $this->countUncompleted, // ส่งจำนวนงานที่ยังไม่เสร็จ
            'tasktype1' => $this->tasktype1, // ส่งจำนวนงานประเภท 1
            'tasktype2' => $this->tasktype2, // ส่งจำนวนงานประเภท 2
            'tasktype3' => $this->tasktype3, // ส่งจำนวนงานประเภท 3
            'tasksData' => $this->tasksData, // ข้อมูลสถานะของงานทั้งหมด
            'typeCountData' => $this->typeCountData, // ข้อมูลจำนวนงานของแต่ละ user (ใช้ในกราฟแท่ง)
            'users' => $this->users,
        ]);
    }
}
