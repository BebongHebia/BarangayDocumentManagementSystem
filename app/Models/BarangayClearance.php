<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayClearance extends Model
{
    protected $fillable = [
        'userCode',
        'code',
        'sector',
        'purpose',
        'purposeType',
        'dayIssue',
        'monthIssue',
        'transactionCode',
    ];
}
