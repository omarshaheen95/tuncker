<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    protected $with = ['sub_subject'];
    protected $fillable = [
        'standard', 'sub_subject_id',
    ];

    public function sub_subject()
    {
        return $this->belongsTo(SubSubject::class, 'sub_subject_id');
    }

    public function subject()
    {
        $sub_subject = SubSubject::find($this->sub_subject_id);
        /*$subject = StudentSubject::find($sub_subject->id);
        if(!$subject){
            return false;
        }*/
        return Subject::find($sub_subject->subject_id);
    }

    public function getStandardStudent($standard,$student){
        $result = StudentStandard::where('standard_id', $standard)->where('student_id', $student)->first();
        if(!$result){
            $result = new StudentStandard();
            $result->id = 0;
            $result->student_id = $student;
            $result->standard_id = $standard;
        }
        return $result;
    }
}
