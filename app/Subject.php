<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $appends = ['count_sub_subjects', 'standards'];
    protected $fillable = [
        'ar_name', 'en_name', 'ar_description', 'en_description',
    ];

    public function sub_subjet()
    {
        return $this->belongsTo('App\SubSubject');
    }
    public function getCountSubSubjectsAttribute()
    {
        return SubSubject::where('subject_id', $this->id)->count();
    }

    public function getStandardsAttribute()
    {
        $sub_subjects = SubSubject::where('subject_id', $this->id)->get()->unique()->pluck('id')->all();
        $standards = Standard::whereIn('sub_subject_id', $sub_subjects)->get();
        return $standards;
    }
}
