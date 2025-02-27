<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class SummarySchedule extends Component
{
    public $tasks;
    public $selectedDate;
    public $start_date = [];

    public function mount()
    {
        $this->tasks = Task::orderBy('start_date')
                           ->orderBy('type_id')
                           ->orderBy('task_name')
                           ->get();
    }

    public function updatedSelectedDate($value)
    {
        $this->start_date = Task::whereNotNull('start_date')->pluck('start_date')->toArray();
    }

    public function render()
    {
        return view('livewire.summary-schedule', [
            'tasks' => $this->tasks,
            'start_date' => $this->start_date,
        ]);
    }
}
