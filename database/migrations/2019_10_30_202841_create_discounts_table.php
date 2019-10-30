<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ya_cold_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('line_id')->unsigned()->comment('关联 ya_cold_lines 表');
            $table->integer('user_id')->unsigned()->comment('关联 ya_cold_users 表');
            $table->tinyInteger('discount')->unsigned()->comment('折扣比例');
            $table->timestamps();
        });
        DB::statement("alter table `ya_cold_discounts` comment'亚冷_合同线路表'");    # 增加表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
