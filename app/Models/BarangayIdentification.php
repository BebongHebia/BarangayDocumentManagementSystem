<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayIdentification extends Model
{
    protected $fillable = [
        'userCode',
        'code',
        'sector',
        'dayIssue',
        'monthIssue',
        'transactionCode',
    ];
}