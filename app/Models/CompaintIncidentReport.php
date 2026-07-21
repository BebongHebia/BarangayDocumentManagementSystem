<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompaintIncidentReport extends Model
{
    protected $fillable = [
        'userCode',
        'complainType',
        'description',
        'respondent',
        'status',
        'smsStatus',
        'smsMessage',
    ];
}
