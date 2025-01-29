<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Task extends Model
{
    use HasFactory,Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'task_name',
        'task_detail',
        'start_date',
        'due_date',
        'task_status_id',
        'type_id',
        'user_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $table = 'tasks';

    protected $keyType = 'int';

    protected $primaryKey = 'task_id';

    public $incrementing = true;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($task) {
            if (is_null($task->task_status_id)) {
                $task->task_status_id = 2; // กำหนดค่าเริ่มต้น
            }
        });
    }
    public function task_status()
    {
        return $this->belongsTo(TaskStatus::class, 'task_status_id', 'task_status_id');
    }
    public function task_type()
    {
        return $this->belongsTo(TaskTypes::class, 'type_id', 'type_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function countTask()
    {
        $this->db->select('COUNT(*) AS totalTask');
        $rs = $this->db->get('tasks');
        if ($rs->num_rums() > 0) {
            $data = $rs->row();
            return FALSE;
        }
    }
}
