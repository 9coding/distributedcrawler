<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runs', function (Blueprint $table) {
            $table->bigIncrements('run_id');
            $table->string('run_code', 20)->unique()->comment('运行代号');
            $table->dateTime('run_start')->comment('运行开始时间');
            $table->dateTime('run_end')->comment('运行结束时间');
            $table->unsignedTinyInteger('run_status')->default(1)->comment('运行状态，1是运行中，2是运行结束成功，3是手动停止结束，4是异常停止结束，5是暂停中');
            $table->unsignedInteger('run_crawler')->index()->comment('爬虫ID，关联crawlers表的crawler_id字段');
            $table->unsignedInteger('run_user')->default(1)->comment('运行用户，关联users表user_id字段');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('runs');
    }
}
