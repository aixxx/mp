<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->nullable()->comment('所属公众号');
			$table->integer('group_id')->comment('粉丝组group_id');
			$table->string('openid',100)->nullable()->comment('OPENID');
			$table->string('nickname',300)->comment('昵称');
			$table->string('signature',300)->comment('签名');
			$table->text('remark')->comment('备注');
			$table->enum('sex', ['女','男'])->comment('性别');
			$table->string('language',300)->comment('语言');
			$table->string('city',300)->comment('城市');
			$table->string('province',300)->comment('省');
			$table->string('country',300)->comment('国家');
			$table->string('avatar',300)->comment('头像');
			$table->integer('unionid')->comment('unionid');
			$table->integer('liveness')->comment('用户活跃度');
			$table->timestamp('subscribed_at')->nullable()->default('0000-00-00 00:00:00')->comment('关注时间');
			$table->timestamp('last_online_at')->comment('最后一次在线时间');
			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fans');
    }
}
