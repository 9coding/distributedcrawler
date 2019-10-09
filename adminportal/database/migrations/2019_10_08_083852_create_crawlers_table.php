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
            $table->string('crawler_entry', 50)->comment('爬虫入口，可以是网址或者其它爬虫代号');
            $table->unsignedTinyInteger('crawler_status')->default(1)->comment('爬虫状态，1是停止，2是启动');
            $table->unsignedInteger('crawler_purchase')->default(0)->comment('爬虫购买人数');
            $table->unsignedTinyInteger('crawler_allowbuy')->default(1)->comment('是否允许购买，1是不允许，2是允许，当爬虫允许购买时则自动上架到market中');
            $table->unsignedDecimal('crawler_price', 9, 2)->default(0)->comment('爬虫金额');
            $table->unsignedInteger('crawler_cluster')->index()->default(1)->comment('所属集群，关联clusters表cluster_id字段');
            $table->unsignedInteger('crawler_user')->default(1)->comment('发布用户，关联users表user_id字段');
            $table->unsignedInteger('crawler_category')->default(0)->comment('爬虫类别，关联categories表category_id字段');
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
