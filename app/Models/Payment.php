<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'userCode',
        'tranCode',
        'cedulaNo',
        'cedIssOn',
        'cedIssAt',
        'cedAmount',
        'orNo',
        'orIssOn',
        'orIssAt',
        'orAmount',
        'docAmount',
    ];
}