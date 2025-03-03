<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SummarySchedule extends Component
{
    use WithPagination;

    public $selectedUser;
    public $startDate;
    public $endDate;
    public $dateFilter;

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
        $query = Task::query()
        ->when(Auth::user()->user_status_id != 1, function ($query) {
            $query->where('user_id', Auth::id());
        });

        if ($this->selectedUser) {
            $query->where('user_id', $this->selectedUser);
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('start_date', [$this->startDate, $this->endDate]);
        }

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
        // คำนวณจำนวนงานตามประเภทและบุคคล ตาม startDate และ endDate เฉพาะงานที่ยังไม่เสร็จ
        $taskCountsByUserAndType = Task::query()
            ->selectRaw('users.first_name, task_types.type_name, COUNT(tasks.task_id) as count')
            ->join('users', 'tasks.user_id', '=', 'users.user_id')
            ->join('task_types', 'tasks.type_id', '=', 'task_types.type_id')
            ->when($this->startDate && $this->endDate, function ($query) {
                $query->whereBetween('tasks.start_date', [$this->startDate, $this->endDate]);
            })
            ->when($this->selectedUser, function ($query) {
                $query->where('tasks.user_id', $this->selectedUser);
            })
            ->when(Auth::user()->user_status_id != 1, function ($query) {
                $query->where('tasks.user_id', Auth::id());
            })
            ->groupBy('users.first_name', 'task_types.type_name')
            ->orderBy('users.first_name')
            ->orderBy('task_types.type_name')
            ->get()
            ->groupBy('first_name');

        return view('livewire.summary-schedule', [
            'users' => \App\Models\User::all(),
            'tasks' => $this->loadTasks(),
        ] + compact('taskCountsByUserAndType'));
    }
}
