<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PitchBookingTime extends Model
{
    protected $table= "pitch_booking_time";
    protected  $fillable = ['time', 'day_year'];
}
