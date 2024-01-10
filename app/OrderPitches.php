<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPitches extends Model
{
    protected $table = 'order_pitch';
    protected $fillable =['name', 'uses_id', 'pitch_id', 'price', 'time', 'name_customer','phone','email','address', 'time_id', 'status'];

    const STATUS_SUCCESS = 0;
    const STATUS_CANCEL = 1;
    const STATUS_NO_PAY = 2;
    function pitchTimes(){
        return $this->belongsToMany('App\PitchBookingTime', 'pitch_time_order', 'order_id', 'time_id');
    }
    function pitches(){
        return $this->hasMany('App\Pitches', 'id','pitch_id');
    }
}
