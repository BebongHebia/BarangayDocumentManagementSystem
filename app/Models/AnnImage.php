<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnImage extends Model
{
    protected $fillable = [
        'code',
        'file',
        'path',
    ];
}