<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarActivity extends Model
{
    protected $fillable = [
        'code',
        'activity',
        'description',
        'dateStart',
        'dateEnd',
        'status',
    ];

    public function getCalActImage(){
        return $this->belongsTo(ActImage::class, 'code', 'code');
    }
    
}