<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsQue extends Model
{
    protected $fillable = [
        'userCode',
        'name',
        'phone',
        'transactionCode',
        'docType',
        'smsStatus',
        'code',
        'actType',
        'remarks',
    ];
}
