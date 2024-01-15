<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_setup')->insert([
            [
                'id'=>1,
                'price_weekend' => 7,
                'price_peak' => 5,
            ]
        ]);
    }
}
