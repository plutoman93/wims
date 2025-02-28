<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Task;
use Carbon\Carbon;

class SummarySchedule extends Component
{
    use WithPagination;

    public $selectedUser;
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = Carbon::now()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
    }

    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function loadTasks()
    {
        $query = Task::query();

        if ($this->selectedUser) {
            $query->where('user_id', $this->selectedUser);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('start_date', [$this->startDate, $this->endDate]);
        }

        // กรองเฉพาะงานที่มีสถานะยังไม่เสร็จ
        $query->where('task_status_id', 2);

        return $query->paginate(10);
    }

    public function prevDate()
    {
        $this->startDate = Carbon::parse($this->startDate)->subDay()->format('Y-m-d');
        $this->endDate = Carbon::parse($this->endDate)->subDay()->format('Y-m-d');
        $this->resetPage();
    }

    public function nextDate()
    {
        $this->startDate = Carbon::parse($this->startDate)->addDay()->format('Y-m-d');
        $this->endDate = Carbon::parse($this->endDate)->addDay()->format('Y-m-d');
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.summary-schedule', [
            'users' => \App\Models\User::all(),
            'tasks' => $this->loadTasks(),
        ]);
    }
}
