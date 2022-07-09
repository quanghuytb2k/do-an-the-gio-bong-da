<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pitches extends Model
{
    protected $table= "football_pitches";
    protected  $fillable = ['name', 'price', 'address' , 'note' , 'phone_number', 'name_pitch' , 'description', 'images','star_rating'];
    function pitchBookingTimes(){
        return $this->belongsToMany('App\PitchBookingTime', 'pitches_time', 'pitches_id', 'time_id');
    }
    function orders(){
        return $this->belongsToMany('App\OrderPitches', 'football_pitches_order', 'pitches_id', 'order_id');
    }
}
