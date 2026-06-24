<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'what',
        'when',
        'where',
        'how',
        'code',
    ];


    public function image(){
        return $this->hasOne(AnnImage::class, 'code', 'code');
    }
}