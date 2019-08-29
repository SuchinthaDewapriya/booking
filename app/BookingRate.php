<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingRate extends Model
{
    public function booking()
    {
        return $this->belongsTo('App\Booking', 'b_id');
    }
}
