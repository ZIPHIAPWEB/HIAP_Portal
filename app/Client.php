<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'contact_no',
        'school',
        'user_id',
        'fb_link'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function grade()
    {
        return $this->hasMany('App\Grade', 'user_id', 'user_id');
    }

    public function userProgram()
    {
        return $this->hasMany('App\UserProgram', 'user_id', 'user_id');
    }
    
    public function course()
    {
        return $this->hasOne('App\Course', 'id', 'course');
    }
    
    public function lesson()
    {
        return $this->hasMany('App\Lesson', 'program_id', 'program_id');
    }
}
