<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceUser extends Model
{
    //
    protected $table = 'service_users';
    protected $fillable = [
        'user_id',
        'service_id',
    ];

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
