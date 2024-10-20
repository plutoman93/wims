<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithFileUploads as LivewireWithFileUploads;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use WithFileUploads;
    use LivewireWithFileUploads;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'username',
    //     'email',
    //     'password',
    // ];

    // ระบุ primary key ที่ใช้
    protected $primaryKey = 'user_id';

    // ถ้า primary key ไม่ใช่ auto-increment ให้กำหนดเป็น false
    public $incrementing = true;  // ถ้าฟิลด์ `user_id` เป็น auto-increment ให้ใช้ true

    // ระบุชนิดข้อมูลของ primary key
    protected $keyType = 'int';  // ถ้าฟิลด์ `user_id` เป็น integer

    public function user()
    {
        return $this->hasOne(Status::class);
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'department_id', 'department_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class,'user_status_id','user_status_id');
    }
    public function title()
    {
        return $this->belongsTo(Title::class,'title_id','title_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class,'account_status_id','account_status_id');
    }
    public function task()
    {
        return $this->belongsTo(Task::class,'user_id','user_id');
    }

    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
