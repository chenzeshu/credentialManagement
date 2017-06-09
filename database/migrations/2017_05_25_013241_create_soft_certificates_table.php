<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soft_certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();  //软件类别
            $table->string('name');  //软件名称
            $table->string('id1')->nullable();  //著作权登记号
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('path_auth')->nullable(); //著作权扫描件 二期数组
            $table->string('path_soft')->nullable(); //软件登记扫描件 二期数组
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
        Schema::dropIfExists('soft_certificates');
    }
}
