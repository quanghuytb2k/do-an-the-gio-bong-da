<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pitches extends Model
{
    protected $table= "football_pitches";
    protected  $fillable = ['name', 'price', 'address' , 'note' , 'phone_number', 'name_pitch' , 'description', 'images','star_rating','province', 'district', 'commune', 'user_id', 'province', 'district', 'commune'];
    function pitchBookingTimes(){
        return $this->belongsToMany('App\PitchBookingTime', 'pitches_time', 'pitches_id', 'time_id');
    }
    function orders(){
        return $this->belongsToMany('App\OrderPitches', 'football_pitches_order', 'pitches_id', 'order_id');
    }
    function order_pitchs(){
        return $this->belongsTo('App\OrderPitches',  'id', 'pitch_id');
    }
}
