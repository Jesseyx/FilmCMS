<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_blocks', function (Blueprint $table) {
            $table->increments('id');
            // 标题
            $table->string('title', 100);
            // 副标题
            $table->string('sub_title', 50)->nullable();
            // 轮播图 url
            $table->string('img_url');
            // 跳转 url
            $table->string('link_path')->nullable();
            $table->string('description')->nullable();
            // 是否广告
            $table->tinyInteger('is_ad')->default(0);
            // 待上架，已上架，未上架
            $table->tinyInteger('status')->default(0);
            // 上下架时间
            $table->timestamp('up_time');
            $table->timestamp('down_time');
            // 资源 id
            $table->integer('source_id')->default(0);
            // 资源类型
            $table->tinyInteger('resource_type');
            // 平台
            $table->string('platform', 50);
            // 审计用户 id
            $table->string('audit_user_id', 20);
            // 排序
            $table->integer('order', false, true)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('banner_blocks');
    }
}
