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
    public $dates;

    protected $queryString = ['selectedUser', 'typeFilter', 'dateFilter'];

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
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        $users = User::all();
        $taskTypes = TaskTypes::all();

        return view('livewire.summary-schedule', compact('tasks', 'users', 'taskTypes', ));
    }
}
