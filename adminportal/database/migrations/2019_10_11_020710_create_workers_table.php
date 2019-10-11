<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('worker_id');
            $table->string('worker_code', 10)->unique()->comment('机器代号，由系统自动生成唯一值');
            $table->string('worker_name', 20)->comment('机器名称，别名');
            $table->unsignedTinyInteger('worker_status')->default(1)->comment('机器状态，1是可用，2是不可用');
            $table->unsignedInteger('worker_cluster')->index()->default(1)->comment('所属集群，关联clusters表cluster_id字段');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('workers');
    }

}
