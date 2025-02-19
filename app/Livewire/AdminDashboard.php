<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Component
{
    public $count, $countCompleted, $countUncompleted, $tasksData = [];

    public function taskCount()
    {
        if (Auth::user()->user_status_id == 1) {
            $this->count = Task::count();
            $this->countCompleted = Task::where('task_status_id', 1)->count();
            $this->countUncompleted = Task::where('task_status_id', 2)->count();
        } else {
            $userId = Auth::user()->id;
            $this->count = Task::where('user_id', $userId)->count();
            $this->countCompleted = Task::where('user_id', $userId)->where('task_status_id', 1)->count();
            $this->countUncompleted = Task::where('user_id', $userId)->where('task_status_id', 2)->count();
        }
    }

    public function mount()
    {
        if (Auth::user()->user_status_id == 1) {
            $this->tasksData = [
                'labels' => ['งานทั้งหมด', 'งานที่เสร็จแล้ว', 'งานที่กำลังทำ'],
                'data' => [
                    Task::count(),
                    Task::where('task_status_id', 1)->count(),
                    Task::where('task_status_id', 2)->count(),
                    Task::where('task_status_id', -3)->count()
                ]
            ];
        } else {
            $userId = Auth::user()->id;
            $this->tasksData = [
                'labels' => ['งานทั้งหมด', 'งานที่เสร็จแล้ว', 'งานที่กำลังทำ'],
                'data' => [
                    Task::where('user_id', $userId)->count(),
                    Task::where('user_id', $userId)->where('task_status_id', 1)->count(),
                    Task::where('user_id', $userId)->where('task_status_id', 2)->count(),
                    //Task::where('user_id', $userId)->where('task_status_id', 3)->count()
                ]
            ];
        }
    }

    public function render()
    {
        $this->taskCount();
        return view('livewire.admin-dashboard', [
            'count' => $this->count,
            'countCompleted' => $this->countCompleted,
            'countUncompleted' => $this->countUncompleted,
            'tasksData' => $this->tasksData,
        ]);
    }
}
