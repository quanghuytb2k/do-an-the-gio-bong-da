<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PitchBookingTime extends Model
{
    const PEAK_START = '18:00';

    const PEAK_END = '21:00';

    const WEEKEND = ['saturday','sunday'];

    protected $table= "pitch_booking_time";
    protected  $fillable = ['time_start', 'day_year', 'time_end', 'status', 'price','pitch_id', 'type'];
    function pitches(){
        return $this->belongsToMany('App\Pitches', 'pitches_time', 'time_id', 'pitches_id');
    }
    function orders(){
        return $this->belongsToMany('App\PitchBookingTime', 'pitch_time_order', 'order_id', 'time_id');
    }
    const STATUS_NORMAL = 1;
    const STATUS_CHOOSING = 2;
    const STATUS_ORDERED = 3;

    const pitch_type_5 = 1;
    const pitch_type_7 = 2;
    const pitch_type_11 = 3;

    const MAP_TYPE = [
        self::pitch_type_5 => 'Sân 5',
        self::pitch_type_7 => 'Sân 7',
        self::pitch_type_11 => 'Sân 11',
    ];

    static function getTypeName($type){
        return self::MAP_TYPE[$type];
    }
}
