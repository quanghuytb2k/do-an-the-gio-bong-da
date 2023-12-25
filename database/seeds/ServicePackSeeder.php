<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicePackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_packs')->insert(
            [
                [
                    'name' => 'Gói dùng thử',
                    'price' => 0,
                    'service_id' => 1,
                    'time_to_use_value' => 1,
                    'time_to_use_unit' => 'week'
                ],
                [
                    'name' => 'Gói 1 tháng',
                    'price' => 200000,
                    'service_id' => 1,
                    'time_to_use_value' => 1,
                    'time_to_use_unit' => 'month'
                ],
                [
                    'name' => 'Gói 1 năm',
                    'price' => 2000000,
                    'service_id' => 1,
                    'time_to_use_value' => 1,
                    'time_to_use_unit' => 'year'
                ],
                [
                    'name' => 'Gói dùng thử',
                    'price' => 0,
                    'service_id' => 2,
                    'time_to_use_value' => 1,
                    'time_to_use_unit' => 'week'
                ],
                [
                    'name' => 'Gói 1 tháng',
                    'price' => 200000,
                    'service_id' => 2,
                    'time_to_use_value' => 1,
                    'time_to_use_unit' => 'month'
                ],
                [
                    'name' => 'Gói 1 năm',
                    'price' => 2000000,
                    'service_id' => 2,
                    'time_to_use_value' => 1,
                    'time_to_use_unit' => 'year'
                ],
                [
                    'name' => 'Gói dùng thử',
                    'price' => 0,
                    'service_id' => 2,
                    'time_to_use_value' => 1,
                    'time_to_use_unit' => 'week'
                ],
                [
                    'name' => 'Gói 1 tháng',
                    'price' => 300000,
                    'service_id' => 2,
                    'time_to_use_value' => 1,
                    'time_to_use_unit' => 'month'
                ],
                [
                    'name' => 'Gói 1 năm',
                    'price' => 3000000,
                    'service_id' => 2,
                    'time_to_use_value' => 1,
                    'time_to_use_unit' => 'year'
                ],
            ]
        );
    }
}
