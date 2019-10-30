<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ya_cold_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name', 100)->comment('名字');
            $table->decimal('price',8 , 2)->comment('价格');
            $table->timestamps();
        });
        DB::statement("alter table `ya_cold_lines` comment'亚冷_线路表'");    # 增加表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lines');
    }
}
