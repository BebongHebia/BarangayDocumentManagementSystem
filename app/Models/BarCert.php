<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarCert extends Model
{
    protected $fillable = [
        'userCode',
        'code',
        'sector',
        'residentYears',
        'purposeType',
        'purpose',
        'isFirstTimeJobSeeker',
        'dayIssue',
        'monthIssue',
        'transactionCode',
    ];
}