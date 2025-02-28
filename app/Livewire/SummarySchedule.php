<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TaskTypes;
use Carbon\Carbon;

class SummarySchedule extends Component
{
    use WithPagination;

    public $selectedUser = '';
    public $typeFilter = '';
    public $dateFilter = '';
    public $search = '';
    public $statusFilter = '';
    public $dates;

    protected $queryString = ['selectedUser', 'typeFilter', 'dateFilter', 'search', 'statusFilter'];

    public function mount()
    {
        $this->dates = Task::select('start_date')->distinct()->orderBy('start_date', 'desc')->pluck('start_date');

        if (!$this->dateFilter && $this->dates->isNotEmpty()) {
            $this->dateFilter = $this->dates->first();
        }
    }

    public function updatedDateFilter()
    {
        $this->resetPage();
    }

    public function updatedTypeFilter()
    {
        $this->resetPage();
    }

    public function updatedSelectedUser()
    {
        $this->resetPage();
    }

    public function nextDate()
    {
        $currentIndex = $this->dates->search($this->dateFilter);
        if ($currentIndex !== false && $currentIndex < $this->dates->count() - 1) {
            $this->dateFilter = $this->dates[$currentIndex + 1];
            $this->resetPage();
        }
    }

    public function prevDate()
    {
        $currentIndex = $this->dates->search($this->dateFilter);
        if ($currentIndex !== false && $currentIndex > 0) {
            $this->dateFilter = $this->dates[$currentIndex - 1];
            $this->resetPage();
        }
    }

    private function getCurrentPageTaskIds()
    {
        return collect(Task::query()
            ->when(Auth::user()->user_status_id !== 1, function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->when($this->selectedUser, function ($query) {
                $query->where('user_id', $this->selectedUser);
            })
            ->when($this->dateFilter, function ($query) {
                $query->where('start_date', $this->dateFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->items())
            ->pluck('task_id')
            ->toArray();
    }


    public function render()
    {
        Carbon::setLocale('th');

        $tasks = Task::query()
            ->when(Auth::user()->user_status_id !== 1, function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->when($this->selectedUser, function ($query) {
                $query->where('user_id', $this->selectedUser);
            })
            ->when($this->typeFilter, function ($query) {
                $query->where('type_id', $this->typeFilter);
            })
            ->when($this->dateFilter, function ($query) {
                $query->where('start_date', $this->dateFilter);
            })
            ->when($this->statusFilter, function ($query) {
                if ($this->statusFilter == '1') {
                    $query->where('task_status_id', '1');
                } elseif ($this->statusFilter == '2') {
                    $query->where('task_status_id', '2');
                }
            })
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        $taskCountsByType = Task::query()
        ->selectRaw('task_types.type_name, COUNT(tasks.task_id) as count')
        ->join('task_types', 'tasks.type_id', '=', 'task_types.type_id')
        ->when($this->dateFilter, function ($query) {
            $query->where('tasks.start_date', $this->dateFilter);
        })
        ->when(Auth::user()->user_status_id != 1, function ($query) {
            $query->where('tasks.user_id', Auth::id());
        })
        ->groupBy('task_types.type_name')
        ->orderBy('count', 'desc')
        ->pluck('count', 'task_types.type_name');

        // 🔹 คำนวณจำนวนงานตามผู้ใช้
        $taskCountsByUserAndType = Task::query()
    ->selectRaw('users.first_name, task_types.type_name, COUNT(tasks.task_id) as count')
    ->join('users', 'tasks.user_id', '=', 'users.user_id')
    ->join('task_types', 'tasks.type_id', '=', 'task_types.type_id')
    ->when($this->dateFilter, function ($query) {
        $query->where('tasks.start_date', $this->dateFilter);
    })
    ->when(Auth::user()->user_status_id != 1, function ($query) {
        $query->where('tasks.user_id', Auth::id());
    })
    ->groupBy('users.first_name', 'task_types.type_name')
    ->orderBy('users.first_name')
    ->orderBy('task_types.type_name')
    ->get()
    ->groupBy('first_name');


        $users = User::all();
        $taskTypes = TaskTypes::all();

        return view('livewire.summary-schedule', compact(
            'tasks', 'users', 'taskTypes',
        'taskCountsByType', 'taskCountsByUserAndType'
        ));
    }
}
