<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
   protected $fillable = ['name', 'content', 'price', 'thumbnail', 'code', 'old_price', 'amount', 'cat_id', 'trademake', 'origin', 'size', 'type_sole'];
}
