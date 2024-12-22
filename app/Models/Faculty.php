<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'faculty_id';
    public function user()
    {
        return $this->hasMany(User::class, 'faculty_id', 'faculty_id');
    }
    public function department()
    {
        return $this->hasMany(Department::class, 'faculty_id', 'faculty_id');
    }
}
