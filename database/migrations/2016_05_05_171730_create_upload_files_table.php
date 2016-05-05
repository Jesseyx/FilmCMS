<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('real_name', 128);
            $table->string('path');
            $table->string('type', 16);
            $table->string('ext', 16);
            $table->string('real_ext', 16);
            $table->unsignedInteger('file_size');
            // 上传者
            $table->unsignedInteger('uploader');
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
        Schema::drop('upload_files');
    }
}
