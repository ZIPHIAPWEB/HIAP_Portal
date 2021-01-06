<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'cert_no', 'name', 'school', 'program', 'total_grade', 'gold_medal', 'silver_medal', 'bronze_medal', 'total_medal'
    ];
}