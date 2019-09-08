<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('preface');
            $table->text('img')->nullable()->comment('图片 445*190');
            $table->unsignedInteger('view_count')->default(0)->comment('浏览数');
            $table->integer('order')->nullable()->default(0);
            $table->text('body');
            $table->integer('categories_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('last_user_id')->unsigned();
//            定义这张表的id 必须为`users`表的外键
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussions');
    }
}
