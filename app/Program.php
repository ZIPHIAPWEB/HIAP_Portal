<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function clients()
    {
        return $this->hasMany('App\Client', 'program_id', 'id');
    }
}
