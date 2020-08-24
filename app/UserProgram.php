<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProgram extends Model
{
    protected $fillable = [
        'user_id',
        'program_id',
        'application_status'
    ];

    public function client()
    {
        return $this->hasOne('App\Client', 'user_id', 'user_id');
    }
    
    public function program()
    {
        return $this->hasOne('App\Program', 'id', 'program_id');
    }
}
