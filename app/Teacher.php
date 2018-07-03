<?php

namespace App;

use App\Notifications\TeacherResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ar_name', 'en_name', 'email', 'password', 'ar_address', 'en_address', 'phone', 'school_id', 'ar_description', 'en_description', 'image', 'active',
    ];
    protected $appends = ['count_students'];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TeacherResetPassword($token));
    }

    public function getCountStudentsAttribute()
    {
        return Student::where('teacher_id', $this->id)->count();
    }
}
