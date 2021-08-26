<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ClientInitial extends Model
{
    protected $fillable = [
        'user_id',
        'initial_id',
        'status',
        'file_path'
    ];
}
