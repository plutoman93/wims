<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class SummarySchedule extends Component
{

    public $tasks;
    public $delete_id;
    public $search = '';
    public $selectedTasks = [];
    public $selectAll = false;
    public $selectedUser = '';
    public $statusFilter = '';
    public $typeFilter = ''; // เพิ่มตัวแปรสำหรับ filter ชนิดงาน



    protected $listeners = ['deleteConfirmed' => 'deleteTask', 'deleteSelectedConfirmed' => 'deleteSelectedTasks']; // รับ Event จาก SweetAlert
    protected $queryString = ['search']; // ทำให้ Search Query ถูกเก็บไว้ใน URL

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
            $this->selectedTasks = array_diff($this->selectedTasks, $currentPageTaskIds); // ลบเฉพาะรายการของหน้าปัจจบัน
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

    public function render()
    {
        return view('livewire.summary-schedule');
    }
}
