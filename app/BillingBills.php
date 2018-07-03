<?php

namespace App;

use Lang;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BillingBills extends Model
{
    protected $fillable = [
        'school_id', 'NORV', 'active_to', 'accepted',
    ];

    protected $appends = ['m_active', 'isActive'];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y/m/d');
    }

    public function getMActiveAttribute()
    {
        if($this->accepted == 0){
            return Lang::get('pricing.unpaid');
        }else{
            return Lang::get('pricing.Driven');
        }
    }


    public function getIsActiveAttribute()
    {
        $now = Carbon::now();
        if(!is_null($this->active_to) &&  $now <= $this->active_to){
            return Lang::get('pricing.effective');
        }elseif(!is_null($this->active_to) && $now > $this->active_to){
            return Lang::get('pricing.expired');
        }else{
            return Lang::get('pricing.not_effective');
        }
    }
}
