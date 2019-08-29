<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('用户名');
            $table->string('avatar')->comment('头像');
            $table->string('email')->unique()->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->string('confirm_code',64)->comment('验证码');
            $table->integer('is_confirmed')->default(1)->comment('是否验证,0否,1是');
            $table->timestamp('email_verified_at')->nullable()->comment('验证时间');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::statement("alter table `users` comment'用户表'");    # 增加表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
