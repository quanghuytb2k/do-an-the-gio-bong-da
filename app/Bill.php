<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $fillable =['name_product','qty','customers_id','payment','total'];
    function Customer(){
        return $this->belongsTo('App\Customer');
    }

}
