<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $count;
    public $countCompleted;
    public $countUncompleted;
    public $tasksInProgress;
    public $tasksData = [];

    public function taskCount()
    {
        $this->count = Task::count();
        $this->countCompleted = Task::where('task_status_id', 1)->count();
        $this->countUncompleted = Task::where('task_status_id', 2)->count();
        $this->tasksInProgress = Task::where('task_status_id', 3)->count();
    }

    public function mount()
    {
        $this->tasksData = [
            'labels' => ['งานทั้งหมด','งานที่เสร็จแล้ว', 'งานที่ยังไม่เสร็จแล้ว', 'งานที่กำลังทำ'],
            'data' => [
                Task::count(),
                Task::where('task_status_id', 1)->count(),
                Task::where('task_status_id', 2)->count(),
                Task::where('task_status_id', 3)->count()
            ]
        ];
    }

    public function render()
    {
        $this->taskCount();
        return view('livewire.admin-dashboard', [
            'count' => $this->count,
            'countCompleted' => $this->countCompleted,
            'countUncompleted' => $this->countUncompleted,
            'tasksInProgress' => $this->tasksInProgress,
            'tasksData' => $this->tasksData,
        ]);
    }
}
