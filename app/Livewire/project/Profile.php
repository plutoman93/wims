<?php

namespace App\Livewire\Project;

use App\Models\User;
use App\Models\Department;
use App\Models\Faculty;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    use WithFileUploads;

    public $first_name, $last_name, $email, $phone, $photo, $title_name, $department_name, $faculty_name, $username, $password;
    public $title_id, $department_id, $faculty_id, $user_status_id;
    public $filteredDepartments = [];

    public function mount()
    {
        $this->loadUserData();
    }

    public function loadUserData()
    {
        $user = Auth::user();

        // ดึงข้อมูลจาก User
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->title_id = $user->title_id;
        $this->department_id = $user->department_id;
        $this->faculty_id = $user->faculty_id;
        $this->username = $user->username;
        $this->password = ''; // ไม่โหลดรหัสผ่านเดิม

        // โหลดรายการสาขาตามคณะที่เลือก
        $this->updateDepartments($this->faculty_id);
    }

    public function updateDepartments($faculty_id)
    {
        if ($faculty_id) {
            $this->filteredDepartments = Department::where('faculty_id', $faculty_id)->get();
        } else {
            $this->filteredDepartments = Department::all();
        }
    }

    public function updatedFacultyId($value)
    {
        $this->faculty_id = $value;
        $this->department_id = null; // รีเซ็ตค่า department_id
        $this->updateDepartments($this->faculty_id);
    }

    public function updateProfile()
    {
        try {
            $user = User::find(Auth::id());

            $user->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
                'title_id' => $this->title_id,
                'faculty_id' => $this->faculty_id,
                'department_id' => $this->department_id,
                'username' => $this->username,
                'password' => $this->password ? bcrypt($this->password) : $user->password,
            ]);

            // แจ้งเตือนว่าอัปเดตข้อมูลสำเร็จ
            session()->flash('message', 'อัปเดตข้อมูลสำเร็จแล้ว');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function resetForm()
    {
        $this->loadUserData();
    }

    public function render()
    {
        return view('livewire.account_setting', [
            'faculties' => Faculty::all(),
            'departments' => $this->filteredDepartments,
        ]);
    }
}
