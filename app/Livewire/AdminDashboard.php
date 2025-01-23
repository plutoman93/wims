<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $count;
    public function taskCount()
    {
        $count = Task::table('tasks')->count(); // Corrected table name to 'tasks'
        return view('admin-dashboard', ['count' => $count]);
    }

    public function render()
    {
        $count = Task::count();
        return view('livewire.admin-dashboard', compact('count'));
    }
}
