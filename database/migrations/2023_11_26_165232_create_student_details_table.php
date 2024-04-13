<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('login_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->timestamp('login_at')->nullable();
            $table->string('user_agent')->nullable();
        });
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('lv_name');
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('c_name');
            $table->foreignId('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->string('c_logo');
            $table->integer('total_modules')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('m_name');
            $table->foreignId('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreignId('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('lesson_name');
            $table->foreignId('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreignId('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreignId('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_history');
        Schema::dropIfExists('levels');
        Schema::dropIfExists('learnings');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('lesson');
    }
}
