<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attestation extends Model
{
    protected $fillable = [
        'code',
        'userCode',
        'age',
        'status',
        'income',
        'typeOfAssistance',
        'totalMonthlyHousholdExpense',
        'transactionCode',
    ];
}
