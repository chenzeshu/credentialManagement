<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCredentialBasicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credential_basics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('path', 1000)->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('credential_1s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('path', 1000)->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('credential_2s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('path', 1000)->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('credential_3s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('path', 1000)->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('credential_4s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('path', 1000)->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('credential_5s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('path', 1000)->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('credential_6s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('path', 1000)->nullable();
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
        Schema::dropIfExists('credential_basics');
        Schema::dropIfExists('credential_1s');
        Schema::dropIfExists('credential_2s');
        Schema::dropIfExists('credential_3s');
        Schema::dropIfExists('credential_4s');
        Schema::dropIfExists('credential_5s');
        Schema::dropIfExists('credential_6s');
    }
}
