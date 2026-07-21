<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterList extends Model
{
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'suffix',
        'birthdate',
        'placeOfBirth',
        'sex',
        'bloodType',
        'civilStatus',
        'religion',
        'address',
        'citizenship',
        'profession',
        'contact',
        'email',
        'educationalAtt',
        'resType',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'listCode', 'listCode');
    }
}
