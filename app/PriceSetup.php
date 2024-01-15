<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceSetup extends Model
{
    protected $table= "price_setup";
    protected  $fillable = ['price_peak','price_weekend'];
}
