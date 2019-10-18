<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->string('admin_email', 30)->unique()->comment('邮箱，登录用');
            $table->string('password', 255);
            $table->unsignedTinyInteger('admin_level')->default(2)->comment('管理员等级，1是超级管理员');
            $table->string('admin_name', 20)->comment('用户昵称');
            $table->unsignedInteger('admin_loginip')->default(0)->comment('本次登录的IP地址');
            $table->dateTime('admin_logindate')->comment('本次登录的日期');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }

}
