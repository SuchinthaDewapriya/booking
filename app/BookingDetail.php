<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    public function booking()
    {
        return $this->belongsTo('App\Booking', 'b_id',);
    }
}
