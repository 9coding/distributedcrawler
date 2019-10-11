<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('notifies', function (Blueprint $table) {
            $table->bigIncrements('notify_id');
            $table->string('notify_content', 500)->comment('通知内容');
            $table->dateTime('notify_date')->comment('通知日期');
            $table->unsignedTinyInteger('notify_status')->default(1)->comment('通知读取状态，1是未读，2是已读');
            $table->unsignedInteger('notify_user')->index()->default(0)->comment('接收通知用户，关联users表user_id字段');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('notifies');
    }

}
