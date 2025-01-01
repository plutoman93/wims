<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name',
        'task_detail',
        'start_date',
        'due_date',
        'type_id',
        'user_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $keyType = 'int';

    protected $primaryKey = 'task_id';

    public $incrementing = true;

    public function tasks()
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
