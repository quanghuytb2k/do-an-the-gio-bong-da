<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'name',
        'description'
    ];

    const BOOKING = 1;
    const SELL = 2;
    const ALL = 3;
}
