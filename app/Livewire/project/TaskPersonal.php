<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\Auth;
use SweetAlert\SweetAlert;

class TaskPersonal extends Component
{
    use WithPagination;

    public $tasks;

    public $search = '';

    protected $queryString = ['search']; // ทำให้ Search Query ถูกเก็บไว้ใน URL

    public function updatingSearch()
    {
        $this->resetPage(); // รีเซ็ตหน้าปัจจุบันเมื่อค้นหาใหม่
    }

    public function delete($task_id)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'ยืนยันการลบ?',
            'text' => 'คุณต้องการลบข้อมูลนี้หรือไม่?',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'ใช่, ลบเลย!',
            'cancelButtonText' => 'ยกเลิก',
            'id' => $task_id // เพิ่ม id เข้าไปด้วย
        ]);
    }

    public function deleteConfirmed($task_id)
    {
        $model = Task::findOrFail($task_id);
        if ($model) { // ตรวจสอบว่า $model ไม่เป็น null
            $model->deleted_by = Auth::user()->user_id;
            $model->save(); // อย่าลืม save() หลังจากแก้ไข property
            $model->delete();
            $this->dispatch('swal:success', [
                'title' => 'ลบข้อมูลเรียบร้อยแล้ว',
                'icon' => 'success'
            ]);
        } else {
            // ถ้า $model เป็น null แสดงว่าไม่พบ Task ที่ต้องการลบ
            $this->dispatch('swal:error', [
                'title' => 'ไม่พบข้อมูลที่ต้องการลบ',
                'icon' => 'error'
            ]);
        }
    }

    public function mount()
    {
        $this->tasks = Task::all();
    }

    public function taskStatus($task_id, $task_status_id)
    {
        $task = Task::findOrFail($task_id);
        $task->task_status_id = $task_status_id; // กำหนดค่า task_status_id ใหม่
        $task->save();

        $this->tasks = Task::all();
    }

    public function render()
    {
        $data = Task::query()
            ->when(Auth::user()->user_status_id !== 1, function ($query) {
                $query->where('user_id', Auth::id()); // ดูเฉพาะ Task ของตัวเอง ถ้าไม่ใช่ admin
            })
            ->when($this->search, function ($query) {
                $query->where('task_name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10); // ใช้ Pagination

        return view('livewire.project.viewtask', compact('data'));
    }
}
