<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
   public function user(){
    return $this->belongsTo(User::class);
   }
   public function sessions(){
    return $this->hasMany(EventSession::class);
   }
}
