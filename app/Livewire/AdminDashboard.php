<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $count;
    public $countCompleted;
    public $countUncompleted;

    public function taskCount()
    {
        $this->count = DB::table('tasks')->count();
    }

    public function taskCompletedCount()
    {
        $this->countCompleted = DB::table('tasks')->where('task_status_id', 1)->count();
    }

    public function taskUncompletedCount()
    {
        $this->countUncompleted = DB::table('tasks')->where('task_status_id', 2)->count();
    }

    public function render()
    {
        $this->taskCount();
        $this->taskCompletedCount();
        $this->taskUncompletedCount();
        // You can call taskCount or taskCompletedCount here if needed
        return view('livewire.admin-dashboard', ['count' => $this->count]);
    }
}
