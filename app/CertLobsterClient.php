<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertLobsterClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'cert_id_main',
        'cert_id',
        'full_name',
        'school',
        'course',
        'hours',
        'lobster_layout_id'
    ];

    public function layout()
    {
        return $this->hasOne('App\CertLobsterLayout', 'id', 'lobster_layout_id');
    }
}
