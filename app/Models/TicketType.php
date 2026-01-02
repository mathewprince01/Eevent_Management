<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $guarded = [];
    public function event(){
        return $this->belongsTo(Event::class);
    }
     public function registrations(){
        return $this->hasMany(Registration::class,'ticket_type_id');
     }
}
