<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout_product extends Model
{
    //
    protected $table = 'checkout_product';
    
    public $timestamp = false;
    protected $fillable =['checkout_id','product_id','qty'];
    function Checkouts(){
        return $this->belongsTo('App\Product','checkout_id','id');
    }
    function Products(){
        return $this->belongsTo('App\Product','product_id','id');
    }
}
