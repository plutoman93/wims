<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Component
{
    public $count, $countCompleted, $countUncompleted, $taskCounts;

    public function taskCount()
    {
        $userId = Auth::id(); // ดึง user_id ของผู้ใช้ที่ล็อกอินอยู่

        $this->count = Task::where('user_id', $userId)->count();
        $this->countCompleted = Task::where('user_id', $userId)->where('task_status_id', 1)->count();
        $this->countUncompleted = Task::where('user_id', $userId)->where('task_status_id', 2)->count();
    }

    public function taskTypeCount()
    {
        $userId = Auth::id(); // ดึง user_id ของผู้ใช้ที่ล็อกอิน
        $this->taskCounts = Task::join('task_types', 'tasks.type_id', '=', 'task_types.type_id') // เชื่อมกับ task_types
            ->select('tasks.type_id', 'task_types.type_name') // ดึง type_id และ type_name
            ->selectRaw('COUNT(*) as count') // นับจำนวนงานตาม type_id
            ->where('tasks.user_id', $userId) // กรองเฉพาะงานของ user ที่ล็อกอิน
            ->where('tasks.task_status_id', '!=', 1) // นับเฉพาะงานที่ยังไม่เสร็จ
            ->groupBy('tasks.type_id', 'task_types.type_name') // Group by ให้ตรงกับ select
            ->get();
    }


    public function render()
    {
        $this->taskCount();
        $this->taskTypeCount();

        return view('livewire.dashboard', [
            'count' => $this->count,
            'countCompleted' => $this->countCompleted,
            'countUncompleted' => $this->countUncompleted,
            'taskCounts' => $this->taskCounts
        ]);
    }
}
