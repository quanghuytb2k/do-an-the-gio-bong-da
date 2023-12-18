<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTypeIntoTablePitchBookingTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('pitch_booking_time')) {
            if (!Schema::hasColumn('pitch_booking_time', 'type')) {
                Schema::table('pitch_booking_time', function (Blueprint $table) {
                    $table->tinyInteger('type')->nullable()->default(1)->comment('Loại sân: 1 là sân 5, 2 là sân 7, 3 là sân 11');
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
        if (Schema::hasTable('pitch_booking_time') && Schema::hasColumn('pitch_booking_time', 'type')) {
            Schema::table('pitch_booking_time', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
}
