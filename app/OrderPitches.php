<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPitches extends Model
{
    protected $table = 'order_pitch';
    protected $fillable =['name', 'uses_id', 'pitch_id', 'price', 'time'];
}
