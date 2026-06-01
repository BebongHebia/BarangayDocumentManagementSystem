<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterList extends Model
{
    protected $fillable = [
        'listCode',
        'firstName',
        'middleName',
        'lastName',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'listCode', 'listCode');
    }
}