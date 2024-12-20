<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'task_status_id',
    //     'task_status_name', // เพิ่มคอลัมน์นี้ลงใน fillable
    // ];
    protected $guarded = [];
    public function taskstatus()
    {
        return $this->hasMany(Task::class, 'task_status_id', 'task_status_id');
    }
}
