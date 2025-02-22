<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Component
{
    public $count, $countCompleted, $countUncompleted, $tasksData = [], $typeCountData = [], $labels = [], $data = [], $users = [];
    public $taskCounts;
    public function taskCount()
    {
        $this->count = Task::count();
        $this->countCompleted = Task::where('task_status_id', 1)->count();
        $this->countUncompleted = Task::where('task_status_id', 2)->count();
    }

    public function taskTypeCount()
{
    $this->taskCounts = Task::select('type_id')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('type_id')
            ->get();
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
        $this->taskTypeCount();


        return view('livewire.admin-dashboard', [
            'count' => $this->count, // ส่งตัวแปร count ไปที่ view
            'countCompleted' => $this->countCompleted, // ส่งจำนวนงานที่เสร็จแล้ว
            'countUncompleted' => $this->countUncompleted, // ส่งจำนวนงานที่ยังไม่เสร็จ
            'tasksData' => $this->tasksData, // ข้อมูลสถานะของงานทั้งหมด

        ]);
    }
}
