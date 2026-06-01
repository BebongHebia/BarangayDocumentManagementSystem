<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilePic extends Model
{
    protected $fillable = [
        'userCode',
        'path',
        'fileName',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'userCode', 'userCode');
    }
}
