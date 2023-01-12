<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PitchBookingTime extends Model
{
    protected $table= "pitch_booking_time";
    protected  $fillable = ['time_start', 'day_year', 'time_end', 'status', 'price','pitch_id'];
    function pitches(){
        return $this->belongsToMany('App\Pitches', 'pitches_time', 'time_id', 'pitches_id');
    }
    function orders(){
        return $this->belongsToMany('App\PitchBookingTime', 'pitch_time_order', 'order_id', 'time_id');
    }
}
 