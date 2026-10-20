<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cedula extends Model
{
    protected $fillable = [
        'resType',
        'userCode',
        'cedulaNo',
        'dateAcquired',
        'validity',
        'completeName',
        'address',
        'placeOfBirth',
        'dateOfBirth',
        'civilStatus',
        'height',
        'weight',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userCode', 'userCode');
    }
}
