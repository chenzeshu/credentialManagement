<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id1')->nullable();  //申请号
            $table->string('id2')->nullable();  //专利证书号/公告号
            $table->string('name')->nullable();  //专利名称
            $table->string('type')->nullable();  //专利类别
            $table->string('time_apply')->nullable();
            $table->string('time_start')->nullable();
            $table->string('time_authorize')->nullable();  //授权日期
            $table->string('time_end')->nullable();
            $table->string('time_end_year')->nullable();  //维护截止年份
            $table->string('path')->nullable(); //专利证书扫描件
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('patents');
    }
}
