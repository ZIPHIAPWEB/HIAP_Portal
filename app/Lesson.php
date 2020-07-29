<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'program_id',
        'title',
        'description'
    ];

    public function grade()
    {
        return $this->hasOne('App\Grade', 'lesson_id', 'id');
    }
}
