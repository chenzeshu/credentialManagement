<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistroysTable extends Migration
{
    /**
     * Run the migrations.
     * 本表用于存储所有提交表单的历史数据
     * @return void
     */
    public function up()
    {
        Schema::create('histroys', function (Blueprint $table) {
            $table->increments('id');  //表id //todo 外键，用于详情表的同类归属|| 100人*52周*2张/周 = 10400张/年， 距500W上限低，做好索引没有压力
            $table->integer('user_id');  //提交人的id //todo 索引，用于查找隶属本人的表
            //思路: 采用with方法拿到username
            $table->integer('checker_id'); //审批人id  //todo 索引，方便审批人搜索到所有跟自己有关的审批表
            //思路: 采用with方法拿到checker_name
            //思路： 前期，checker_id在提交时，已经指定了是高/钱，所以这基本是个固定的值
            //思路： 后期， role为checker的人，可以使用checkController进行check审批工作,然后index为本表所有和自己的id一样的人，check表可以将本表打上自己的user_id
            $table->integer('reason_type'); //提交审批的类型, 以后审批类型单独维护,可能要改成reason_id, 做成ORM
            $table->string('reason_project'); //提交审批相关的项目名称
            $table->string('reason_words'); //提交审批的理由
            $table->integer('examine_type');  //表单的状态  0:提交审核中, 1: 审核通过, 2:驳回待修改;   理论上草稿状态不会出现
            $table->string('rejection_reason')->nullable(); //驳回理由
            $table->timestamp('end_at')->nullable(); //过期时间, 通过审批给予
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
        Schema::dropIfExists('histroys');
    }
}
