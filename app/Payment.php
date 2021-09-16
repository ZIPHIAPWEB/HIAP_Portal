<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'date_paid',
        'mop',
        'program_fee',
        'amount_paid',
        'purpose', 
        'isVerified', 
        'path', 
        'paid_from'
    ];

    public function track()
    {
        return $this->hasOne('App\UserProgram','id', 'course_id');
    }
}
