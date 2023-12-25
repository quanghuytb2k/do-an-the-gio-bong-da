<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicePack extends Model
{
    //
    protected $table = 'service_packs';
    protected $fillable = [
        'name',
        'time_to_use_value',
        'time_to_use_unit',
        'price'
    ];

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
