<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('components', function (Blueprint $table) {
            $table->bigIncrements('component_id');
            $table->string('component_code', 20)->comment('组件代号，例如list');
            $table->string('component_fullcode', 50)->comment('组件全称，与所属爬虫代号crawler_code和组件代号component_code一起组成具体执行组件，例如tmall_list');
            $table->string('component_cluster', 10)->comment('组件运行集群代号，关联clusters表cluster_code字段');
            $table->string('component_output', 50)->comment('组件运行结果输出表名，根据组件code自动生成');
            $table->unsignedTinyInteger('component_order')->comment('组件执行顺序');
            $table->unsignedInteger('component_crawler')->index()->comment('组件所属爬虫ID，关联crawlers表的crawler_id字段');
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
        Schema::dropIfExists('components');
    }

}
