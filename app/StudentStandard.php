<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StudentStandard extends Model
{
    protected $fillable = [
        'student_id', 'standard_id', 'u_type', 'u_status','t_type', 't_status','a_type', 'a_status','m_type', 'm_status','e_type', 'e_status',
    ];

    public function sub_subject()
    {
        return $this->belongsTo(SubSubject::class, 'sub_subject_id');
    }

    public function subject()
    {
        $subject = StudentSubject::find($this->sub_subject_id);
        return Subject::find($subject->subject_id);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function standard()
    {
        return $this->belongsTo(Standard::class);
    }

    public function getUTypeAttribute($value)
    {
        $date = new Carbon($value);
        return $date->format('jS F Y'); 
    }

    public function getTTypeAttribute($value)
    {
        $date = new Carbon($value);
        return $date->format('jS F Y'); 
    }
    public function getATypeAttribute($value)
    {
        $date = new Carbon($value);
        return $date->format('jS F Y'); 
    }
    public function getMTypeAttribute($value)
    {
        $date = new Carbon($value);
        return $date->format('jS F Y'); 
    }
    public function getMEypeAttribute($value)
    {
        $date = new Carbon($value);
        return $date->format('jS F Y'); 
    }

    public function rate_about_school($standard_id, $student_id)
    {
        $student = Student::find($student_id);
        $standard = Standard::find($standard_id);
        $studentStandard = StudentStandard::where('student_id',$student_id)->where('standard_id', $standard_id)->first();
    
        //dd($standard->subject());

        if(!$standard || !$student || !$studentStandard){
            return '0 %';
        }

        $students = Student::where('school_id', $student->school_id)->get()->unique()->pluck('id')->all();
        
        $student_subject_count = StudentSubject::whereIn('student_id',$students)->where('subject_id', $standard->subject()->id)->count();

        $student_subject = StudentSubject::whereIn('student_id',$students)->where('subject_id', $standard->subject()->id)->get()->unique()->pluck('student_id')->all();

        $studentStandards_id = StudentStandard::whereIn('student_id', $student_subject)->where('standard_id', $standard_id)->where('t_status', '1')->get()->unique()->pluck('student_id')->all();
        $studentStandards_count = StudentStandard::whereIn('student_id', $student_subject)->where('standard_id', $standard_id)->where('t_status', '1')->count();

        //dd($student_subject);

        if($studentStandard->e_status){
            $studentStandards = StudentStandard::whereIn('student_id', $studentStandards_id)->where('standard_id', $standard_id)->where('e_status', '1')->count();
        }elseif($studentStandard->m_status){
            $studentStandards = StudentStandard::whereIn('student_id', $studentStandards_id)->where('standard_id', $standard_id)->where('m_status', '1')->count();
        }elseif($studentStandard->a_status){
            $studentStandards = StudentStandard::whereIn('student_id', $studentStandards_id)->where('standard_id', $standard_id)->where('a_status', '1')->count();
        }elseif($studentStandard->t_status){
            $studentStandards = StudentStandard::whereIn('student_id', $studentStandards_id)->where('standard_id', $standard_id)->where('t_status', '1')->count();
        }else{
            $studentStandards = StudentStandard::whereIn('student_id', $studentStandards_id)->where('standard_id', $standard_id)->where('u_status', '1')->count();
        }

        
        $count_students = Student::where('school_id', $student->school_id)->count();
        //$studentStandards = StudentStandard::whereIn('student_id', $student_subject)->where('standard_id', $standard_id)->where('t_status', '1')->count();


        //dd($studentStandard->u_status);
        if($studentStandards == 0 || $count_students == 0 || $studentStandards_count == 0){
            return '0 %';
        }

        $result = round(($studentStandards / $studentStandards_count) * 100 ,1) . ' %';
        return $result;


    }

    public function rate_about_system($standard_id, $student_id)
    {
        $standard = Standard::find($standard_id);
        $studentStandard = StudentStandard::where('student_id',$student_id)->where('standard_id', $standard_id)->first();
    
        //dd($standard->subject());

        if(!$standard ||  !$studentStandard){
            return '0 %';
        }

        $students = Student::all()->unique()->pluck('id')->all();
        
        $student_subject_count = StudentSubject::where('subject_id', $standard->subject()->id)->get()->unique()->pluck('student_id')->count();

        $student_subject = StudentSubject::where('subject_id', $standard->subject()->id)->get()->unique()->pluck('student_id')->all();

        $studentStandards_id = StudentStandard::whereIn('student_id', $student_subject)->where('standard_id', $standard_id)->where('t_status', '1')->get()->unique()->pluck('student_id')->all();
        $studentStandards_count = StudentStandard::whereIn('student_id', $student_subject)->where('standard_id', $standard_id)->where('t_status', '1')->count();

        //dd($student_subject);

        if($studentStandard->e_status){
            $studentStandards = StudentStandard::whereIn('student_id', $studentStandards_id)->where('standard_id', $standard_id)->where('e_status', '1')->count();
        }elseif($studentStandard->m_status){
            $studentStandards = StudentStandard::whereIn('student_id', $studentStandards_id)->where('standard_id', $standard_id)->where('m_status', '1')->count();
        }elseif($studentStandard->a_status){
            $studentStandards = StudentStandard::whereIn('student_id', $studentStandards_id)->where('standard_id', $standard_id)->where('a_status', '1')->count();
        }elseif($studentStandard->t_status){
            $studentStandards = StudentStandard::whereIn('student_id', $studentStandards_id)->where('standard_id', $standard_id)->where('t_status', '1')->count();
        }else{
            $studentStandards = StudentStandard::whereIn('student_id', $studentStandards_id)->where('standard_id', $standard_id)->where('u_status', '1')->count();
        }

        
        //$count_students = Student::where('school_id', $student->school_id)->count();
        //$studentStandards = StudentStandard::whereIn('student_id', $student_subject)->where('standard_id', $standard_id)->where('t_status', '1')->count();


        //dd($studentStandard->u_status);
        if($studentStandards == 0 || $studentStandards_count == 0){
            return '0 %';
        }

        $result = round(($studentStandards / $studentStandards_count) * 100 ,1) . ' %';
        return $result;


    }
}
