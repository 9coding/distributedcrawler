<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClustersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('clusters', function (Blueprint $table) {
            $table->bigIncrements('cluster_id');
            $table->string('cluster_code', 10)->unique()->comment('集群代号，由系统自动生成唯一值');
            $table->string('cluster_name', 20)->comment('集群名称');
            $table->string('cluster_description', 300)->comment('集群简介');
            $table->unsignedTinyInteger('cluster_status')->default(1)->comment('集群状态，1是可用，2是不可用');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('clusters');
    }

}
