<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTypes extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_name',
        // 'created_by',
        // 'updated_by',
        // 'deleted_by',
    ];

    public $incrementing = true;

    protected $primaryKey = 'type_id';

    protected $keyType = 'int';

    public function task_type()
    {
        return $this->hasMany(Task::class,'type_id','type_id');
    }
}
