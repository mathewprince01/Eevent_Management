<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    public function user(){
     return $this->belongsTo(User::class);
    }
    public function registration(){
        return $this->hasMany(registration::class);
    }
}
