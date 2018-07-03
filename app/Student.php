<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    protected $fillable = [
        'ar_name', 'en_name', 'school_id', 'teacher_id', 'dob', 'nationality', 'year_lang', 'image',
    ];

    //protected $with = ['school', 'teacher'];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::parse($value);
    }

    public function getDobAttribute($value)
    {
        $date=date_create($value);
        return date_format($date , "Y/m/d");
    }
}
