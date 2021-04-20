<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateLayout extends Model
{
    protected $fillable = [
        'id', 'name', 'f_style', 'img_path'
    ];
}
