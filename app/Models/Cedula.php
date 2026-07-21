<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cedula extends Model
{
    protected $fillable = [
        'userCode',
        'cedulaNo',
        'dateAcquired',
        'validity',
    ];
}
