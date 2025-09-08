<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        $this->belongsTo(Client::class, 'id', 'industry_id');
    }
}
