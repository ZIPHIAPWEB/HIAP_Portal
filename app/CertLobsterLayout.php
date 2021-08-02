<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CertLobsterLayout extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'f_style',
        'img_path'
    ];

    public function getImgPathAttribute($value) 
    {
        return Storage::url($value);
    }

    public function certStyles()
    {
        return $this->hasMany('App\CertStyle', 'cert_id', 'id');
    }
}
