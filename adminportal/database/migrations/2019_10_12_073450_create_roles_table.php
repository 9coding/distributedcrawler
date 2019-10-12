<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('role_id');
            $table->string('role_name', 20)->comment('角色名称');
            $table->unsignedTinyInteger('role_status')->default(1)->comment('状态，1是正常，2是停用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('roles');
    }

}
