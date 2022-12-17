<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{
    //
    protected $fillable = [
        'products_id', 'checkouts_id',
    ];
}
