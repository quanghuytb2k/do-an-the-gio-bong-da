<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    //

    protected $fillable =['name','email','addres','phonenumber','product','soluong','payment','giatri','status','code','coupon_id', 'total_coupon', 'total_pay'];
    function products(){
        return $this->belongsToMany('App\Product');
    }

    function coupons(){
        return $this->belongsTo('App\Coupon','coupon_id','id');
    }

}
