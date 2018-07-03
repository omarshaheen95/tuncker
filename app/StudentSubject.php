<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    protected $fillable = [
        'student_id', 'subject_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
