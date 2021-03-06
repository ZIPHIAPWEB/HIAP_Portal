<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProgram extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function client()
    {
        return $this->hasOne('App\Client', 'user_id', 'user_id');
    }
    
    public function program()
    {
        return $this->hasOne('App\Program', 'id', 'program_id');
    }

    public function course()
    {
        return $this->hasOne('App\OnlineProgram', 'id', 'course_id');
    }

    public function payment()
    {
        return $this->hasMany('App\Payment', 'user_id', 'user_id');
    }
}
