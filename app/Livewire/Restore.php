<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Task;
use Livewire\Component;

class Restore extends Component
{
    public $users, $tasks;

    public function mount() // โหลดข้อมูล User และ Task ที่ถูกลบ
    {
        $this->users = collect();
        $this->tasks = collect();
        $this->showTrash();
    }

    public function showTrash() // แสดงข้อมูล User และ Task ที่ถูกลบ
    {
        $this->users = User::onlyTrashed()->get();
        $this->tasks = Task::onlyTrashed()->get();

        // return view('livewire.restore')->with('users', $this->users)->with('tasks', $this->tasks);
    }

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        $this->refreshUsers();
    }

    public function restoreTask($id)
    {
        $task = Task::onlyTrashed()->find($id);
        $task->restore();
        $this->refreshTasks();
    }

    public function refreshUsers()
    {
        $this->users = User::onlyTrashed()->get(); // โหลดข้อมูล User ที่ถูกลบ
    }

    public function refreshTasks()
    {
        $this->tasks = Task::onlyTrashed()->get(); // โหลดข้อมูล Task ที่ถูกลบ
    }

    public function render()
    {
        return view('livewire.restore')->with('users', $this->users)->with('tasks', $this->tasks);
    }
}
