<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTypePaymentIntoTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('order_pitch')) {
            if (!Schema::hasColumn('order_pitch', 'type_payment')) {
                Schema::table('order_pitch', function (Blueprint $table) {
                    $table->tinyInteger('type_payment')->nullable()->default(1)->comment('Lưu phương thức thanh toán: 1: Thanh toán trực tiếp, 2: Thanh toán qua momo, 3: Thanh toán qua VNPAY');
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
        if (Schema::hasTable('order_pitch')) {
            if (Schema::hasColumn('order_pitch', 'type_payment')) {
                Schema::table('order_pitch', function (Blueprint $table) {
                    $table->dropColumn('type_payment');
                });
            }
        }
    }
}
