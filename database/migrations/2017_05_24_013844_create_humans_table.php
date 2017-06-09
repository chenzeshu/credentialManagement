<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHumansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('humans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('credit')->nullable();
            $table->string('sex')->nullable();
            $table->string('profession')->nullable();
            $table->string('qualification')->nullable();
            $table->string('degree')->nullable();
            $table->string('title')->nullable();  //可能有多个职称,一期只考虑一个,二期中间加个空格或中文逗号即可.
            $table->string('skill')->nullable(); //可能有多个技能培训名称,一期只考虑一个,二期中间加个空格或中文逗号即可.
            $table->string('time_enter')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('remark')->nullable();
            $table->string('path_i')->nullable(); //证件照扫描件路径
            $table->string('path_credit')->nullable();  //身份证扫描件路径
            $table->string('path_qualification')->nullable(); //学历证书扫描件路径
            $table->string('path_degree')->nullable();  //学位证书扫描件
            $table->string('path_title')->nullable();  //职称证书扫描件
            $table->string('path_skill')->nullable();  //技能培训证书扫描件
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
        Schema::dropIfExists('humans');
    }
}
