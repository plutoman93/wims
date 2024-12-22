<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Task extends Model
{
    use HasFactory;
    protected $primaryKey = 'task_id';
    protected $guarded = [];
    protected static function booted()
    {
        static::creating(function ($task) {
            // กำหนดค่า task_status_id
            $task->task_status_id = Task::max('task_status_id') + 1 ?? 1;

            // กำหนดค่า type_id
            $task->type_id = Task::max('type_id') + 1 ?? 1;

            // กำหนดค่า user_id โดยอ้างอิงว่า user_id ไหนสร้าง task
            $task->user_id = Auth::id();
        });
    }
    public function taskstatus()
    {
        return $this->belongsTo(TaskStatus::class, 'task_status_id', 'task_status_id');
    }
    public function tasktype()
    {
        return $this->belongsTo(TaskTypes::class, 'type_id', 'type_id');
    }
    public function userid()
    {
        return $this->hasMany(User::class, 'user_id', 'user_id');
    }
}
