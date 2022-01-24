<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Initial extends Model
{
    protected $guarded = [];

    public function clientInitial()
    {
        return $this->hasOne('App\ClientInitial', 'initial_id', 'id')->withDefault([
            'status'    =>  false
        ]);
    }
}
