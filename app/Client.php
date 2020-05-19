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
        'program_id',
        'user_id',
        'application_status'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function program()
    {
        return $this->hasOne('App\Program', 'id', 'program_id');
    }
}
