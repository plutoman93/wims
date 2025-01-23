<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $count;
    // public function taskCount()
    // {
    //     $count = Task::count(); // ใช้ Eloquent เพื่อดึงข้อมูลจำนวนเรกคอร์ดใน tasks table
    //     return view('livewire.admin-dashboard', ['count' => $count]); // ชื่อ View ควรตรงกับไฟล์จริง
    // }


    public function render()
    {
        $count = Task::count();
        return view('livewire.admin-dashboard', compact('count'));
    }
}
