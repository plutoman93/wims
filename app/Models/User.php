<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
        return $this->belongsTo(Status::class, 'user_status_id', 'user_status_id');
    }

    public function title()
    {
        return $this->belongsTo(Title::class, 'title_id', 'title_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_status_id', 'account_status_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'user_id', 'user_id');
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
