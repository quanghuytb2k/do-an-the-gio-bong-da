<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPitches extends Model
{
    protected $table= "order_pitch";
    protected  $fillable = ['name', 'uses_id', 'pitch_id', 'price', 'time'];
    function pitches(){
        return $this->belongsToMany('App\Pitches', 'football_pitches_order', 'order_id', 'pitches_id');
    }
}
