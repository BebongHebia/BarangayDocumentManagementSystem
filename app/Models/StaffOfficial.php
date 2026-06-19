<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffOfficial extends Model
{
    protected $fillable = [
        'completeName',
        'sex',
        'bday',
        'birthPlace',
        'civilStatus',
        'position',
        'status',
        'code',
        'profile_photo', // Add this field
    ];

    public function staffImage(){
        return $this->belongsTo(StaffOfficialProfile::class, 'code', 'code');
    }
}