<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertStyle extends Model
{
    use HasFactory;

    protected $fillable = [
        'cert_id',
        'name',
        'class_name',
        'style',
        'raw_style'
    ];

    public function getRawStyleAttribute($value) 
    {
        return json_decode($value, true);
    }

    public function CertLobsterLayout()
    {
        return $this->belongsTo('App\CertLobsterlayout');
    }
}
    