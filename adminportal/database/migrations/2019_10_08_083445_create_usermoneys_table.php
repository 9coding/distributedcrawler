<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsermoneysTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('usermoneys', function (Blueprint $table) {
            $table->bigIncrements('money_id');
            $table->unsignedInteger('money_user')->index()->comment('用户ID，对应users表的user_id字段');
            $table->unsignedTinyInteger('money_reason')->comment('余额变更原因，1是订单支付时使用余额，2是账户充值得到的余额，3是订单退款到余额，4是管理员在后台修改余额');
            $table->unsignedDecimal('money_num',9, 2)->default(0)->comment('当次变更的余额数量');
            $table->enum('money_change', ['+','-'])->comment('余额变更类型，+代表增加积分，-代表减少积分');
            $table->string('money_order', 20)->default('')->comment('订单号，关联purchases表的purchase_num字段');
            $table->dateTime('money_date')->comment('余额变更日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('usermoneys');
    }

}
