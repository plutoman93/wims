<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskTypes;
use Carbon\Carbon;
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
    public $typeFilter = ''; // เพิ่มตัวแปรสำหรับ filter ชนิดงาน
    public $selectedTasks = [];
    public $selectAll = false;

    protected $listeners = ['deleteConfirmed' => 'deleteTask', 'deleteSelectedConfirmed' => 'deleteSelectedTasks']; // รับ Event จาก SweetAlert
    protected $queryString = ['search', 'selectedUser', 'statusFilter', 'typeFilter']; // ทำให้ Search Query ถูกเก็บไว้ใน URL

    public function mount() // โหลดข้อมูล Task
    {
        $this->tasks = Task::all(); // โหลดข้อมูล Task ทั้งหมด
        $this->updateTaskStatus(); // เรียกฟังก์ชันอัปเดตสถานะงาน
    }

    public function updatingSearch()
    {
        $this->resetPage(); // รีเซ็ตหน้าปัจจุบันเมื่อค้นหาใหม่
    }

    public function updatedSelectAll($value)
    {
        $currentPageTaskIds = $this->getCurrentPageTaskIds(); // ดึง Task ในหน้าปัจจุบัน

        if ($value) {   // ถ้ากดเลือกทั้งหมด
            // รวมรายการเดิม + หน้าปัจจุบัน
            $this->selectedTasks = array_merge($this->selectedTasks, $currentPageTaskIds); // รวมรายการเดิม + หน้าปัจจุบัน
        } else {
            // ลบเฉพาะรายการของหน้าปัจจุบัน
            $this->selectedTasks = array_diff($this->selectedTasks, $currentPageTaskIds); // ลบเฉพาะรายการของหน้าปัจจุบัน
        }
    }

    public function toggleSelectAll()
    {
        $currentPageTaskIds = $this->getCurrentPageTaskIds(); // ดึง Task ในหน้าปัจจุบัน

        if ($this->selectAll) {
            // ถ้ากดแล้วให้เอาทุก Task ในหน้านี้ออก
            $this->selectedTasks = array_diff($this->selectedTasks, $currentPageTaskIds); // ลบเฉพาะรายการของหน้าปัจจุบัน
            $this->selectAll = false; // ปรับสถานะเป็น false
        } else {
            // ถ้ายังไม่กดเลือกทั้งหมด ให้เพิ่มเฉพาะ Task ในหน้านี้
            $this->selectedTasks = array_merge($this->selectedTasks, $currentPageTaskIds); // รวมรายการเดิม + หน้าปัจจุบัน
            $this->selectAll = true; // ปรับสถานะเป็น true
        }
    }

    private function getCurrentPageTaskIds()
    {
        return collect(Task::query() // ดึง Task ทั้งหมด
            ->when(Auth::user()->user_status_id !== 1, function ($query) { // ดูเฉพาะ Task ของตัวเอง ถ้าไม่ใช่ admin
                $query->where('user_id', Auth::id()); // ดูเฉพาะ Task ของตัวเอง
            })
            ->when($this->search, function ($query) { // ค้นหา Task
                $query->where('task_name', 'like', '%' . $this->search . '%'); // ค้นหา Task จากชื่อ Task
            })
            ->when($this->selectedUser, function ($query) { // Filter ตามผู้ใช้
                $query->where('user_id', $this->selectedUser); // ค้นหา Task จากผู้ใช้
            })
            ->when($this->statusFilter, function ($query) { // Filter ตามสถานะงาน
                if ($this->statusFilter == '1') { // ถ้าเลือกสถานะงานเป็น 1 (เสร็จสิ้น)
                    $query->where('task_status_id', '1');
                } elseif ($this->statusFilter == '2') { // ถ้าเลือกสถานะงานเป็น 2 (ยังไม่เสร็จสิ้น)
                    $query->where('task_status_id', '2');
                }
            })
            ->when($this->typeFilter, function ($query) { // Filter ตามชนิดงาน
                $query->where('type_id', $this->typeFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10) // `paginate()` คืนค่าเป็น `Paginator`
            ->items()) // ใช้ `.items()` ดึงรายการทั้งหมดจากหน้า Pagination
            ->pluck('task_id') // แปลงเป็น Collection แล้วใช้ pluck()
            ->toArray(); // แปลงเป็น array
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

    public function confirmDeleteSelectedTasks()
    {
        $this->dispatch('confirmDeleteSelected'); // ส่ง Event ไปยัง SweetAlert
    }

    public function deleteSelectedTasks()
    {
        Task::whereIn('task_id', $this->selectedTasks)->delete(); // ลบ Task ที่เลือก
        $this->selectedTasks = []; // รีเซ็ตรายการ Task ที่เลือก
        $this->selectAll = false; // รีเซ็ตการเลือกทั้งหมด
        $this->dispatch('alert', ['type' => 'success', 'message' => 'ลบงานที่เลือกเรียบร้อยแล้ว']);
    }

    public function updateTaskStatus() // อัปเดตสถานะ Task ที่ครบกำหนด
    {
        $tasks = Task::where('task_status_id', 2) // เลือกงานที่ยังไม่เสร็จ
            ->where('due_date', '<', Carbon::now()) // ที่ครบกำหนดแล้ว
            ->get();

        foreach ($tasks as $task) {
            $task->task_status_id = 1; // เปลี่ยนสถานะเป็นเสร็จสิ้น
            $task->save();
        }
    }

    public function taskStatus($task_id, $task_status_id) // อัปเดตสถานะ Task
    {
        $task = Task::findOrFail($task_id); // ค้นหาสถานะ Task ที่ต้องการอัปเดต
        $task->task_status_id = $task_status_id; // กำหนดค่า task_status_id ใหม่
        $task->save();

        $this->tasks = Task::all(); // อัปเดตข้อมูล Task ในคอมโพเนนต์
    }

    public function updatedPage()
    {
        $this->selectedTasks = []; // รีเซ็ตรายการ Task ที่เลือกเมื่อเปลี่ยนหน้า
        $this->selectAll = false; // รีเซ็ตการเลือกทั้งหมดเมื่อเปลี่ยนหน้า
    }

    public function updatedSelectedUser()
    {
        $this->resetPage(); // รีเซ็ต pagination เมื่อเปลี่ยนผู้ใช้
    }

    public function updatedStatusFilter()
    {
        $this->resetPage(); // รีเซ็ต pagination เมื่อเปลี่ยนสถานะงาน
    }

    public function updatedTypeFilter()
    {
        $this->resetPage(); // รีเซ็ต pagination เมื่อเปลี่ยนชนิดงาน
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
            ->when($this->typeFilter, function ($query) { // Filter ตามชนิดงาน
                $query->where('type_id', $this->typeFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10); // ใช้ Pagination

        $users = User::all(); // ดึงข้อมูลผู้ใช้ทั้งหมด
        $taskTypes = TaskTypes::all(); // ดึงข้อมูลชนิดงานทั้งหมด

        return view('livewire.project.viewtask', compact('data', 'users', 'taskTypes')); // ส่งข้อมูลไปยัง View
    }
}
