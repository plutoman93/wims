<?php

namespace App\Livewire\Project;

use App\Models\User;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Title;
use App\Models\Account;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAccounts extends Component
{
    use WithFileUploads;
    public $idd, $username, $first_name, $last_name, $title_name, $phone, $department_name, $faculty_name, $email, $user_status_name, $password;
    public $title_id, $department_id, $faculty_id, $user_status_id;

    public function mount($id)
    {
        $this->loadUserData($id);
    }

    public function loadUserData($id)
    {
        $data = User::find($id);
        $this->idd = $id;
        $this->username = $data->username;
        $this->first_name = $data->first_name;
        $this->last_name = $data->last_name;
        $this->title_id = $data->title_id;
        $this->phone = $data->phone;
        $this->department_id = $data->department_id;
        $this->faculty_id = $data->faculty_id;
        $this->email = $data->email;
        $this->user_status_id = $data->user_status_id;
        $this->password = ''; // ไม่โหลดรหัสผ่านเดิม
    }

    public function edit()
    {
        try {
            $user = User::with('title', 'department', 'faculty')->find($this->idd);

            $user->update([
                'username' => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'phone' => $this->phone,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'title_id' => $this->title_id,
                'faculty_id' => $this->faculty_id,
                'department_id' => $this->department_id,
            ]);
            return redirect()->to(route('personal'));
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function resetForm()
    {
        $this->loadUserData($this->idd); // โหลดข้อมูลเดิม
    }

    public function render()
    {
        return view('livewire.project.edit', [
            'titles' => Title::all(),
            'departments' => Department::all(),
            'faculties' => Faculty::all(),
            'accounts' => Account::all(),
        ]);
    }
}
