<?php

namespace App;

use App\Notifications\SchoolResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class School extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ar_name', 'en_name',  'email', 'password', 'url', 'ar_address', 'en_address', 'phone', 'ar_delegate', 'en_delegate', 'image', 'active','active_to',
    ];
    protected $appends = ['count_students', 'count_teachers'];

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
        $this->notify(new SchoolResetPassword($token));
    }

    public function getAvtiveAttribute()
    {
        if($this->active_to == 1){
            return Lang::get('error.trial');
        }else if($this->active_to == 2){
            return Lang::get('error.active');
        }else if($this->active_to == 3){
            return Lang::get('error.block');
        }else if($this->active_to == 4){
            return Lang::get('error.expire');
        }
        
    }

    public function getCountStudentsAttribute()
    {
        return Student::where('school_id', $this->id)->count();
    }

    public function getCountTeachersAttribute()
    {
        return Teacher::where('school_id', $this->id)->count();
    }

    public function setActiveToAttribute($value)
    {
        $this->attributes['active_to'] = Carbon::parse($value);
    }

    public function getActiveToAttribute($value)
    {
        $date=date_create($value);
        return date_format($date , "Y/m/d");
    }
    
}
