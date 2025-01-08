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
    protected $fillable = ['task_status_name'];

    public $incrementing = true;

    protected $primaryKey = 'task_status_id';

    protected $keyType = 'int';

    public function task_status()
    {
        return $this->hasMany(Task::class, 'task_status_id', 'task_status_id');
    }
}
