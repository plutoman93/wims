<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminDashboard extends Component
{
    public $count,$countCompleted,$countUncompleted,$tasksData = [],$typeCountData = [],$labels = [],
    $data = [];

    public function taskCount()
    {
        //เขียน if else ตรวจสอบสถานะผู้ใช้แล้วค่อยนับงาน
        $this->count = Task::count();
        $this->countCompleted = Task::where('task_status_id', 1)->count();
        $this->countUncompleted = Task::where('task_status_id', 2)->count();
    }

    public function mount()
    {
        $this->tasksData = [
            'labels' => ['งานทั้งหมด','งานที่เสร็จแล้ว','งานที่กำลังทำ'],
            'data' => [
                Task::count(),
                Task::where('task_status_id', 1)->count(),
                Task::where('task_status_id', 2)->count(),
                Task::where('task_status_id', 3)->count()
            ]
        ];
    }

    public function TypeCountData()
    {
        $this->labels = [];
        $this->data = [];

    if (Auth::user()->user_status_id == 1) {
        // ดึงข้อมูลผู้ใช้พร้อมนับจำนวน Task ใน Query เดียว
        $tasksCount = Task::selectRaw('user_id, COUNT(*) as total')
            ->groupBy('user_id')
            ->pluck('total', 'user_id');

        $users = User::all();
        foreach ($users as $user) {
            $this->labels[] = $user->username;
            $this->data[] = $tasksCount[$user->id] ?? 0;
        }
    } else {
        $userId = Auth::user()->id;
        $this->typeCountData =[
            'labels' => ['ปฏิบัติราชการ', 'ลากิจ', 'ประชุม'],
            'data' => [
            Task::where('user_id', $userId)->where('type_id', 1)->count(),
            Task::where('user_id', $userId)->where('type_id', 2)->count(),
            Task::where('user_id', $userId)->where('type_id', 3)->count()
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
