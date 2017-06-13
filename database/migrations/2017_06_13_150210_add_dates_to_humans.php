<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesToHumans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('humans', function (Blueprint $table) {
            $table->timestamp('gather_title_at')->nullable();  //职称获取时间
            $table->timestamp('gather_skill_at')->nullable();  //技能培训及个人荣誉获取时间  一期先一个,二期和skills捆绑成数组
            $table->timestamp('graduated_at')->nullable(); //学历毕业时间
            $table->string('department')->nullable(); //部门
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('humans', function (Blueprint $table) {
            $table->dropColumn('gather_title_at');
            $table->dropColumn('gather_skill_at');
            $table->dropColumn('graduated_at');
            $table->dropColumn('department');
        });
    }
}
