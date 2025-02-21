<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Component
{
    public $count, $countCompleted, $countUncompleted, $tasksData = [], $typeCountData = [], $labels = [], $data = [];

    public function taskCount()
    {
        //เขียน if else ตรวจสอบสถานะผู้ใช้แล้วค่อยนับงาน
        $this->count = Task::count();
        $this->countCompleted = Task::where('task_status_id', 1)->count();
        $this->countUncompleted = Task::where('task_status_id', 2)->count();
    }

    public function countTasksByUser()
    {
        $users = User::all();

        $this->typeCountData = [
            'labels' => $users->pluck('username')->toArray(), // ดึงชื่อผู้ใช้มาเป็น labels
            'data' => $users->map(function ($user) {
                return Task::where('user_id', $user->id)->count(); // นับงานทั้งหมดของผู้ใช้แต่ละคน
            })->toArray()
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
        $this->countTasksByUser();
    }


    public function render()
    {
        // เรียกใช้ taskCount() เพื่ออัปเดตค่าต่างๆ เกี่ยวกับจำนวนงาน
        $this->taskCount();

        return view('livewire.admin-dashboard', [
            'count' => $this->count, // ส่งตัวแปร count ไปที่ view
            'countCompleted' => $this->countCompleted, // ส่งจำนวนงานที่เสร็จแล้ว
            'countUncompleted' => $this->countUncompleted, // ส่งจำนวนงานที่ยังไม่เสร็จ
            'tasksData' => $this->tasksData, // ข้อมูลสถานะของงานทั้งหมด
            'typeCountData' => $this->typeCountData, // ข้อมูลจำนวนงานของแต่ละ user (ใช้ในกราฟแท่ง)
        ]);
    }
}
