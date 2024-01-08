<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserIdIntoTablePitches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('football_pitches')) {
            if (!Schema::hasColumn('football_pitches', 'user_id')) {
                Schema::table('football_pitches', function (Blueprint $table) {
                    $table->unsignedBigInteger('user_id')->nullable()->default(1)->comment('Lưu id chủ sân');
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
        if (Schema::hasTable('football_pitches') && Schema::hasColumn('football_pitches', 'user_id')) {
            Schema::table('football_pitches', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
}
