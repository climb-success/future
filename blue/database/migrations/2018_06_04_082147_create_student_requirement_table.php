<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_requirement',function ($table){
            $table->increments('id');
            $table->string('stu_name',255)->comment('学生名字');
            $table->string('phone',255)->comment('手机');
            $table->string('qq',255)->comment('qq');
            $table->string('goal_school',255)->comment('目标院校');
            $table->string('goal_profession',255)->comment('目标专业');
            $table->timestamp('created_at')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\Illuminate\Support\Facades\DB::raw('"0000-00-00 00:00:00" ON UPDATE CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
