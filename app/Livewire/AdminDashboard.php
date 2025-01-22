<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $count;
    public function taskCount()
    {
        $count = DB::table('tasks')->count(); // Corrected table name to 'tasks'
        return view('admin-dashboard', ['count' => $count]);
    }

    public function render()
    {
        return view('livewire.admin-dashboard',[
        'count' => $this->count, ]);
    }
}
