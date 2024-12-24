<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $first_name, $last_name, $email, $phone, $photo, $title_name, $department_name, $faculty_name;

    public function mount()
    {
        $user = auth()->user();

        // ดึงข้อมูลจาก User
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->title_name = $user->title ? $user->title->title_name : null;
        $this->department_name = $user->department ? $user->department->department_name : null;
        $this->faculty_name = $user->faculty ? $user->faculty->faculty_name : null;
    }

    public function updateProfile()
    {
        try {
            $user = auth()->user();

            // อัปเดตโปรไฟล์รูปภาพหากมีการอัปโหลด
            if ($this->photo) {
                $fullpath = $this->photo->store('photos', 'public');
                $user->profile_photo_path = $fullpath;
            }

            // อัปเดตข้อมูลในตาราง users
            $user->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);

            // อัปเดตข้อมูลในตาราง titles หากมีการกรอก title_name
            if ($this->title_name) {
                if ($user->title) {
                    $user->title->update([
                        'title_name' => $this->title_name,
                    ]);
                } else {
                    $user->title()->create([
                        'title_name' => $this->title_name,
                    ]);
                }
            }

            if ($this->department_name) {
                if ($user->department) {
                    $user->department->update([
                        'department_name' => $this->department_name,
                    ]);
                } else {
                    // กำหนดค่า faculty_id เป็นค่าเริ่มต้นที่ต้องการ
                    $faculty_id = 1;

                    $user->department()->create([
                        'department_name' => $this->department_name,
                        'faculty_id' => $faculty_id, // เพิ่ม faculty_id
                    ]);
                }
            }

            // อัปเดตข้อมูลในตาราง faculties หากมีการกรอก faculty_name
            if ($this->faculty_name) {
                if ($user->faculty) {
                    $user->faculty->update([
                        'faculty_name' => $this->faculty_name,
                    ]);
                } else {
                    $user->faculty()->create([
                        'faculty_name' => $this->faculty_name,
                    ]);
                }
            }

            // แจ้งเตือนว่าอัปเดตข้อมูลสำเร็จ
            session()->flash('message', 'อัปเดตข้อมูลสำเร็จแล้ว');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.account_setting');
    }
}
