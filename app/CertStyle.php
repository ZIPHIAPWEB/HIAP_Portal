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
        'style'
    ];

    public function CertLobsterLayout()
    {
        return $this->belongsTo('App\CertLobsterlayout');
    }
}
    