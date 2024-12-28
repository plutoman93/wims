<?php

namespace App\Livewire\Project;

use App\Models\User;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Title;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAccounts extends Component
{
    use WithFileUploads;
    public $idd, $username, $first_name, $last_name, $title_name, $phone, $department_name, $faculty_name, $email, $user_status_name, $password;

    public function mount($id)
    {
        // dd($id);
        $data = User::find($id);
        $this->idd = $id;
        $this->username = $data->username;
        $this->first_name = $data->first_name;
        $this->last_name = $data->last_name;
        $this->title_name = $data->title ? $data->title->title_name : null;
        $this->phone = $data->phone;
        $this->department_name = $data->department_name;
        $this->faculty_name = $data->faculty_name;
        $this->email = $data->email;
        $this->user_status_name = $data->user_status_name;
        $this->password = $data->password;
    }

    public function edit()
    {
        try {
            // อัปเดตตาราง users
            $user = User::with('title', 'department', 'faculty')->find($this->idd);
            $user->update([
                'username' => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'phone' => $this->phone,
                'email' => $this->email,
                'password' => $this->password,
            ]);

            // อัปเดต title_name ในตาราง titles
            if ($user->title) {
                $user->title->update([
                    'title_name' => $this->title_name,
                ]);
            }
            // อัปเดต faculty_name ในตาราง faculties
            if ($user->faculty) {
                $user->faculty->update([
                    'faculty_name' => $this->faculty_name,
                ]);
            }
            // อัปเดต department_name ในตาราง departments
            if ($user->department) {
                $user->department->update([
                    'department_name' => $this->department_name,
                ]);
            }

            return redirect()->to(route('admin-dashboard'));
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.project.edit');
    }
}
