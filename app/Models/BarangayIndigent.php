<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayIndigent extends Model
{
    protected $fillable = [
        'userCode',
        'code',
        'sector',
        'isAuthorized',
        'authorized',
        'relation',
        'purposeType',
        'purpose',
        'dayIssue',
        'monthIssue',
        'transactionCode',
    ];
}
