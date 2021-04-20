<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateClient extends Model
{
    protected $fillable = [
        'cert_layout_id', 'full_name', 'email', 'school', 'cert_created_at'
    ];

    public function layout()
    {
        return $this->hasOne('App\CertificateLayout', 'id', 'cert_layout_id');
    }
}
