<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_email', 30)->unique()->comment('用户邮箱，登录用');
            $table->string('user_password', 255);
            $table->string('user_name', 20)->comment('用户昵称');
            $table->char('user_phone', 11);
            $table->unsignedInteger('user_point')->default(0)->comment('用户积分');
            $table->unsignedDecimal('user_money', 9, 2)->default(0)->comment('用户余额');
            $table->unsignedTinyInteger('user_status')->default(1)->comment('用户状态，1是正常，2是停用');
            $table->unsignedInteger('user_lastip')->default(0)->comment('上次登录的IP地址');
            $table->dateTime('user_lastdate')->comment('上次登录的日期');
            $table->unsignedInteger('user_currentip')->default(0)->comment('本次登录的IP地址');
            $table->dateTime('user_currentdate')->comment('本次登录的日期');
            $table->char('user_privatekey', 32)->comment('用户私钥，user_email的md5');
            $table->unsignedTinyInteger('user_role')->default(2)->comment('用户角色，关联roles表的role_id字段');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}
