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
        $this->countCompleted = DB::table('tasks')->where('task_status_id', 1)->count();
        $this->countUncompleted = DB::table('tasks')->where('task_status_id', 2)->count();
    }
    public function render()
    {
        $this->taskCount();
        return view('livewire.admin-dashboard', ['count' => $this->count]);
    }
}
