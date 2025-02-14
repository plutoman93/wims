<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskPersonal extends Component
{
    use WithPagination;

    public $tasks;
    public $delete_id;
    public $search = '';
    public $selectedUser = '';
    public $statusFilter = '';

    protected $listeners = ['deleteConfirmed' => 'deleteTask']; // รับ Event จาก SweetAlert
    protected $queryString = ['search', 'selectedUser', 'statusFilter']; // ทำให้ Search Query ถูกเก็บไว้ใน URL

    public function updatingSearch()
    {
        $this->resetPage(); // รีเซ็ตหน้าปัจจุบันเมื่อค้นหาใหม่
    }

    public function delete($task_id) // ลบ Task
    {
        $this->delete_id = $task_id; // ระบุ Task ที่ต้องการลบ
        $this->dispatch('confirmDelete', $task_id);
    }

    public function deleteTask() // ลบ Task
    {
        $task = Task::find($this->delete_id);

        if ($task) {
            $task->deleted_by = Auth::user()->user_id; // ระบุผู้ที่ลบ
            $task->save();
            $task->delete(); // ลบ task

            Log::info('Deleting Task ID: ' . $this->delete_id);
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'ลบ Task เรียบร้อยแล้ว'
            ]);
        } else {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'ไม่พบ Task ที่ต้องการลบ'
            ]);
        }
    }

    public function mount() // โหลดข้อมูล Task
    {
        $this->tasks = Task::all(); // โหลดข้อมูล Task ทั้งหมด
    }

    public function taskStatus($task_id, $task_status_id) // อัปเดตสถานะ Task
    {
        $task = Task::findOrFail($task_id); // ค้นหาสถานะ Task ที่ต้องการอัปเดต
        $task->task_status_id = $task_status_id; // กำหนดค่า task_status_id ใหม่
        $task->save();

        $this->tasks = Task::all(); // อัปเดตข้อมูล Task ในคอมโพเนนต์
    }

    public function updatedSelectedUser()
    {
        $this->resetPage(); // รีเซ็ต pagination เมื่อเปลี่ยนผู้ใช้
    }

    public function updatedStatusFilter()
    {
        $this->resetPage(); // รีเซ็ต pagination เมื่อเปลี่ยนสถานะงาน
    }

    public function render()
    {
        $data = Task::query()
            ->when(Auth::user()->user_status_id !== 1, function ($query) {
                $query->where('user_id', Auth::id()); // ดูเฉพาะ Task ของตัวเอง ถ้าไม่ใช่ admin
            })
            ->when($this->search, function ($query) { // ค้นหา Task
                $query->where('task_name', 'like', '%' . $this->search . '%'); // ค้นหา Task จากชื่อ Task
            })
            ->when($this->selectedUser, function ($query) { // Filter ตามผู้ใช้
                $query->where('user_id', $this->selectedUser);
            })
            ->when($this->statusFilter, function ($query) { // Filter ตามสถานะงาน
                if ($this->statusFilter == '1') {
                    $query->where('task_status_id', '1');
                } elseif ($this->statusFilter == '2') {
                    $query->where('task_status_id', '2');
                }
            })
            ->paginate(10); // ใช้ Pagination

        $users = User::all(); // ดึงข้อมูลผู้ใช้ทั้งหมด

        return view('livewire.project.viewtask', compact('data', 'users')); // ส่งข้อมูลไปยัง View
    }
}
