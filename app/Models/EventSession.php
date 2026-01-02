<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSession extends Model
{
    public function speaker(){
        return $this->belongsTo(Speaker::class);
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
