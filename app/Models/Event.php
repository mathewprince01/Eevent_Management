<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
     use SoftDeletes;
     public function country(){
        return $this->belongsTo(Country::class);
     }
     public function city(){
        return $this->belongsTo(City::class);
     }
     public function organizers(){
        return $this->belongsTo(Organizer::class);

     }
     public function sessions(){
        return $this->hasMany(EventSession::class);
     }

     public function tickets(){
        return $this->hasMany(TicketType::class);
     }

     public function Registrations(){
        return $this->hasMany(Registration::class,'event_id');
     }
}

