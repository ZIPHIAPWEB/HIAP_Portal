<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name', 'description', 'course_id'
    ];

    public function clients()
    {
        return $this->hasMany('App\Client', 'program_id', 'id');
    }

    public function course()
    {
        return $this->hasOne('App\Course', 'id', 'course_id');
    }

    public function onlineProgram()
    {
        return $this->belongsTo('App\OnlineProgram', 'course_id', 'id');
    }
}
