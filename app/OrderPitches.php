<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPitches extends Model
{
    protected $table = 'order_pitch';
    protected $fillable =['name', 'uses_id', 'pitch_id', 'price', 'time', 'name_customer','phone','email','address', 'time_id'];

    function pitchTimes(){
        return $this->belongsToMany('App\PitchBookingTime', 'pitch_time_order', 'order_id', 'time_id');
    }
    function pitches(){
        return $this->hasMany('App\Pitches', 'id','pitch_id');
    }
}
