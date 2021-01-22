<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name',
        'display_name'
    ];

    public function clients()
    {
        return $this->hasMany('App\Client', 'school', 'id');
    }
}
