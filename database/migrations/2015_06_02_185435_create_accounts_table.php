<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60)->comment('公众号名称');
            $table->string('original_id',20)->comment('原始id');
            $table->string('app_id',50)->nullable()->comment('AppId');
            $table->string('app_secret',50)->nullable()->comment('AppSecret');
            $table->string('token',10)->nullable()->comment('加密token');
            $table->string('aes_key',43)->nullable()->comment('AES加密key');
            $table->string('wechat_account',20)->comment('微信号');
            $table->string('tag',30)->comment('接口标识');
            $table->string('access_token',30)->nullable()->comment('微信access_token');
            $table->tinyInteger('account_type')->nullable()->default(1)->comment('类型');
            $table->tinyInteger('sync_status')->nullable()->default(0)->comment('同步状态 0 未同步 1 素材完成同步');
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
        Schema::drop('accounts');
    }
}
