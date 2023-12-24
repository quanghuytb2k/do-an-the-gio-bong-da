<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicePackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_packs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable(false);
            $table->integer('time_to_use_value')->nullable(false);
            $table->string('time_to_use_unit')->nullable(false);
            $table->bigInteger('service_id');
            $table->float('price',12,2)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_packs');
    }
}
