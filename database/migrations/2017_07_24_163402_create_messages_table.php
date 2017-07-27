<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('histroy_id');  //审批表的id  ORM
            $table->string('checker_name');   //审批员姓名
            $table->string('names');    //文件名称（序列化数组）  //fixme 当type=2或3时，变为提交表单的内容? 还是另作一张表？
            $table->string('time');    //时间发生时间
            $table->integer('user_id');  //被通知人id
            $table->integer('type'); //修改为0， 删除为1, //fixme 审批通过为2， 审批拒绝为3? 还是另作一张表？
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
        Schema::dropIfExists('messages');
    }
}
