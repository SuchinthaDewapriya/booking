<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function bookingdetails()
    {
        return $this->hasMany('App\BookingDetail', 'bd_booking_id', 'b_id');
    }
    public function bookingrate()
    {
        return $this->hasMany('App\BookingRate', 'br_bookingid', 'b_id');
    }
}
