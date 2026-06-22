<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActImage extends Model
{
    protected $fillable = [
        'code',
        'fileName',
        'path',
        'activity_id',
    ];
    
    // Relationship with CalendarActivity
    public function activity()
    {
        return $this->belongsTo(CalendarActivity::class);
    }
}