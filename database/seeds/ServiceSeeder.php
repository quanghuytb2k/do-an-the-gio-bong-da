<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'Website đặt lịch',
                    'description' => 'Cung cấp website cho phép quản lý sân bóng và quản lý đặt lịch cho sân bóng của bạn'
                ],
                [
                    'id' => 2,
                    'name' => 'Website bán hàng',
                    'description' => 'Cung cấp web site hộ trỡ quản lý bán hàng cho cửa hàng của bạn'
                ],
                [
                    'id' => 3,
                    'name' => 'Website đặt lịch và bán hàng',
                    'description' => 'Cung cấp website hộ trợ quản lý đặt lịch sân bóng và quản lý bán hàng giúp việc quản lý của bạn dễ dàng hơn'
                ]
            ]
        );
    }
}
