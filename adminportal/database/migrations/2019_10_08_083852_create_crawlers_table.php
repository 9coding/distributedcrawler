<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawlersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('crawlers', function (Blueprint $table) {
            $table->bigIncrements('crawler_id');
            $table->string('crawler_code', 20)->unique()->comment('爬虫代号');
            $table->string('crawler_name', 20)->comment('爬虫名称');
            $table->string('crawler_description', 300)->comment('爬虫简介');
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
        Schema::dropIfExists('crawlers');
    }

}
