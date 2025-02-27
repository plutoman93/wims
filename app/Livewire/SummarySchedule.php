<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class SummarySchedule extends Component
{
    public $tasks;

    public function mount()
    {
        $this->tasks = Task::orderBy('start_date')->get();
    }

    public function render()
    {
        return view('livewire.summary-schedule', [
            'tasks' => $this->tasks,
        ]);
    }
}
