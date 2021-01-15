<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'position',
        'school',
        'contact_no'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo('App\School', 'school', 'id');
    }
}
