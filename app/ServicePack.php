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
        'price',
        'service_id'
    ];

    const PACK_WEEK_VALUE = 1;
    const PACK_MONTH_VALUE = 2;
    const PACK_YEAR_VALUE = 3;

    const PACK_WEEK = 'week';
    const PACK_MONTH = 'month';
    const PACK_YEAR = 'year';

    const PACK_NAME_MAP = [
        self::PACK_WEEK => 'Theo tuần',
        self::PACK_MONTH => 'Theo tháng',
        self::PACK_YEAR => 'Theo năm',
    ];

    public static function getPackName($unit){
        return self::PACK_NAME_MAP[$unit] ?? null;
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
