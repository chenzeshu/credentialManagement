<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageUtilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_utils', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('histroy_id');  //历史表的id, 外键
            $table->integer('file_id'); //文件id
            $table->string('file_name'); //文件名
            $table->string('file_belongs'); //文件属于哪个系统
            $table->text('file_path'); //文件下载路径 ==>用于给审批者查看
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
        Schema::dropIfExists('manage_utils');
    }
}
