<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnProvinceIntoTableFootballPitches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('football_pitches')) {
            if (!Schema::hasColumn('football_pitches', 'province') && !Schema::hasColumn('football_pitches', 'district') && !Schema::hasColumn('football_pitches', 'commune')) {
                Schema::table('football_pitches', function (Blueprint $table) {
                    $table->string('province')->nullable()->comment('Lưu địa chỉ tỉnh/thành phố');
                    $table->string('district')->nullable()->comment('Lưu địa chỉ quận/huyện');
                    $table->string('commune')->nullable()->comment('Lưu địa chỉ xã/phường/thị trấn');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('football_pitches') && Schema::hasColumn('football_pitches', 'province') && Schema::hasColumn('football_pitches', 'district') && Schema::hasColumn('football_pitches', 'commune')) {
            Schema::table('football_pitches', function (Blueprint $table) {
                $table->dropColumn('province');
                $table->dropColumn('district');
                $table->dropColumn('commune');
            });
        }
    }
}
