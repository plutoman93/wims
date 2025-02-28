<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TaskTypes;
use Carbon\Carbon;

class AdminDashboard extends Component
{
    use WithPagination;

    public $count, $countCompleted, $countUncompleted, $tasksData = [], $data = [], $users = [];
    public $taskCounts;
    public $selectedUser = '';
    public $typeFilter = '';
    public $dateFilter = '';
    public $search = '';
    public $statusFilter = '';
    public $dates;

    protected $queryString = ['selectedUser', 'typeFilter', 'dateFilter', 'search', 'statusFilter'];

    public function taskCount()
    {
        $this->count = Task::count();
        $this->countCompleted = Task::where('task_status_id', 1)->count();
        $this->countUncompleted = Task::where('task_status_id', 2)->count();
    }

    public function mount()
    {
        $this->tasksData = [
            'labels' => ['งานทั้งหมด', 'งานที่เสร็จแล้ว', 'งานที่กำลังทำ'],
            'data' => [
                Task::count(),
                Task::where('task_status_id', 1)->count(),
                Task::where('task_status_id', 2)->count(),
            ]
        ];

        $this->startDateQuery();
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

    private function getCurrentPageTaskId()
    {
        return collect(Task::query()
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

    public function startDateQuery()
    {
        $this->dates = Task::select('start_date')->distinct()->orderBy('start_date', 'desc')->pluck('start_date');

        if (!$this->dateFilter && $this->dates->isNotEmpty()) {
            $this->dateFilter = $this->dates->first();
        }
    }

    public function render()
    {
        // เรียกใช้ taskCount() เพื่ออัปเดตค่าต่างๆ เกี่ยวกับจำนวนงาน
        $this->taskCount();
        $this->startDateQuery();
        Carbon::setLocale('th');

        // ตัวแปร $currentPageTaskIds ใช้ในการดึงข้อมูลตามหน้าและการ filter ที่เลือก
        $currentPageTaskIds = $this->getCurrentPageTaskId();

        // เรียกข้อมูล Task ตาม filter
        $tasks = Task::query()
            ->when(Auth::user()->user_status_id !== 1, function ($query) {
                $query->where('user_id', Auth::id()); // If not Admin, show only user's tasks
            })
            ->when($this->selectedUser, function ($query) {
                $query->where('user_id', $this->selectedUser); // Filter by selected user
            })
            ->when($this->dateFilter, function ($query) {
                $query->where('start_date', $this->dateFilter); // Filter by selected date
            })
            ->orderBy('start_date', 'desc') // Order tasks by start date
            ->paginate(10); // Paginate tasks to display 10 per page

        // คำนวณจำนวนงานตามประเภท
        $taskCountsByType = Task::query()
            ->selectRaw('task_types.type_name, COUNT(tasks.task_id) as count')
            ->join('task_types', 'tasks.type_id', '=', 'task_types.type_id')
            ->when($this->dateFilter, function ($query) {
                $query->where('tasks.start_date', $this->dateFilter); // Filter by date
            })
            ->when($this->selectedUser, function ($query) {
                $query->where('tasks.user_id', $this->selectedUser); // Filter by selected user
            })
            ->when(Auth::user()->user_status_id != 1, function ($query) {
                $query->where('tasks.user_id', Auth::id()); // ถ้าไม่ได้เป็น Admin ให้แสดงเฉพาะงานของตัวเอง
            })
            ->groupBy('task_types.type_name')
            ->orderBy('count', 'desc')
            ->pluck('count', 'task_types.type_name');

        // คำนวณจำนวนงานตามประเภทและบุคคล
        $taskCountsByUserAndType = Task::query()
            ->selectRaw('users.first_name, task_types.type_name, COUNT(tasks.task_id) as count')
            ->join('users', 'tasks.user_id', '=', 'users.user_id')
            ->join('task_types', 'tasks.type_id', '=', 'task_types.type_id')
            ->when($this->dateFilter, function ($query) {
                $query->where('tasks.start_date', $this->dateFilter); // Filter by date
            })
            ->when($this->selectedUser, function ($query) {
                $query->where('tasks.user_id', $this->selectedUser); // Filter by selected user
            })
            ->when(Auth::user()->user_status_id != 1, function ($query) {
                $query->where('tasks.user_id', Auth::id()); // ถ้าไม่ได้เป็น Admin ให้แสดงเฉพาะงานของตัวเอง
            })
            ->groupBy('users.first_name', 'task_types.type_name')
            ->orderBy('users.first_name')
            ->orderBy('task_types.type_name')
            ->get()
            ->groupBy('first_name');

        // ดึงข้อมูลผู้ใช้และประเภทงาน
        $users = User::all();

        return view('livewire.admin-dashboard', [
            'count' => $this->count, // ส่งตัวแปร count ไปที่ view
            'countCompleted' => $this->countCompleted, // ส่งจำนวนงานที่เสร็จแล้ว
            'countUncompleted' => $this->countUncompleted, // ส่งจำนวนงานที่ยังไม่เสร็จ
            'tasksData' => $this->tasksData, // ข้อมูลสถานะของงานทั้งหมด
            'taskCounts' => $this->taskCounts, // ข้อมูลจำนวนงานแต่ละประเภท
        ], compact('tasks', 'taskCountsByType', 'taskCountsByUserAndType'));
    }
}
