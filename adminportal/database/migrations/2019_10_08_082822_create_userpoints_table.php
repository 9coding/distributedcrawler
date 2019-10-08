<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserpointsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('userpoints', function (Blueprint $table) {
            $table->bigIncrements('point_id');
            $table->unsignedInteger('point_user')->index()->comment('用户ID，对应users表的user_id字段');
            $table->unsignedTinyInteger('point_reason')->comment('积分变更原因，1是订单支付时使用积分，2是订单成功完成后得到的积分，3是管理员在后台修改积分');
            $table->unsignedInteger('point_num')->default(0)->comment('当次变更的积分数量');
            $table->enum('point_change', ['+','-'])->comment('积分变更类型，+代表增加积分，-代表减少积分');
            $table->string('point_order', 20)->default('')->comment('订单号，关联purchases表的purchase_num字段');
            $table->dateTime('point_date')->comment('积分变更日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('userpoints');
    }

}
