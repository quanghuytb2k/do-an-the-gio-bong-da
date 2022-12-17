<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected $fillable = ['name', 'code', 'quantily', 'feature', 'condition', 'time_start', 'time_end'];
    public function checkouts(){
        return $this->hasMany('App\Checkout');
    }
}
