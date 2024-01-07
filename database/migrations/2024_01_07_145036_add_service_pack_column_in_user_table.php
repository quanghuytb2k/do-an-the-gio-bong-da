<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServicePackColumnInUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            if (!Schema::hasColumn('users', 'service_pack_id')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->tinyInteger('service_pack_id')->nullable(false);
                });
            }
        }
        if (Schema::hasTable('users')) {
            if (!Schema::hasColumn('users', 'service_id')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->tinyInteger('service_id')->nullable(false);
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
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'service_pack_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('service_pack_id');
            });
        }
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'service_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('service_id');
            });
        }
    }
}
