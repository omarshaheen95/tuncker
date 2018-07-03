<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSubject extends Model
{
    protected $appends = ['count_standards'];
    protected $fillable = [
        'ar_name', 'en_name', 'ar_description', 'en_description', 'subject_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function getCountStandardsAttribute()
    {
        return Standard::where('sub_subject_id', $this->id)->count();
    }
}
