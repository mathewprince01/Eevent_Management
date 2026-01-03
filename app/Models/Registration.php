<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $guarded = [];
   public function attendee(){
    return $this->belongsTo(Attendee::class);
   }
   public function event(){
    return $this->belongsTo(Event::class,'event_id');
   }
   public function ticket(){
    return $this->belongsTo(TicketType::class,'ticket_type_id');
   }
}
