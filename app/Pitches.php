<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pitches extends Model
{
    protected $table= "football_pitches";
    protected  $fillable = ['name', 'price', 'address' , 'note' , 'phone_number', 'name_pitch' , 'description', 'images','star_rating'];
}
