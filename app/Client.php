<?php

namespace App;

use Carbon\Carbon as CarbonCarbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Client extends Model
{
    protected $guarded = [];
    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    // public function getExpectedGraduationAttribute($value) 
    // {
    //     $date = new DateTime($value);

    //     return Carbon::instance($date)->format('M Y');
    // }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function grade()
    {
        return $this->hasMany('App\Grade', 'user_id', 'user_id');
    }

    public function school()
    {
        return $this->hasOne('App\School', 'id', 'school_id');
    }

    public function userProgram()
    {
        return $this->hasMany('App\UserProgram', 'user_id', 'user_id')->orderBy('created_at', 'desc');
    }
    
    public function course()
    {
        return $this->hasOne('App\Course', 'id', 'course');
    }
    
    public function lesson()
    {
        return $this->hasMany('App\Lesson', 'program_id', 'program_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'user_id', 'user_id');
    }

    public function onlineProgram()
    {
        return $this->hasOne('App\OnlineProgram', 'id', 'program_id');
    }

    public function get_new_learners()
    {
        return $this->hasMany('App\UserProgram', 'user_id', 'user_id')->where('application_status', 'New Learner');
    }

    public function get_confirmed_learners()
    {
        return $this->hasMany('App\UserProgram', 'user_id', 'user_id')->where('application_status', 'Confirmed Learner');
    }

    public function get_complete_learners()
    {
        return $this->hasMany('App\UserProgram', 'user_id', 'user_id')->where('application_status', 'Complete Learner');
    }
}
