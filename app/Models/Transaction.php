<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'userCode',
        'type',
        'dateCreated',
        'status',
        'code',
        'purpose',
        'validity',
        'remarks',
        'dateSched',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userCode', 'userCode');
    }

    public function payment(){
        return $this->belongsTo(Payment::class, 'code', 'tranCode');
    }
}