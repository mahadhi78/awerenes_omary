<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname',50);
            $table->string('middlename',50);
            $table->string('lastname',50);
            $table->string('dob',10)->nullable();
            $table->string('phone_number',15)->nullable();
            $table->string('username',50)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('email_token')->nullable();
            $table->integer('school_id')->nullable();
            $table->string('status',30)->default('Inactive');
            $table->string('gender',10)->nullable();
            $table->string('photo_path')->nullable();
            $table->string('activation_status',50)->default('Inactive');
            $table->string('is_super_admin',5)->nullable();
            $table->string('userType',50)->default('Staff');
            $table->string('is_approved')->default('Pending');
            $table->string('admision_date')->nullable();
            $table->boolean('is_deleted')->default(false);

            $table->rememberToken();
            $table->timestamps();
            $table->index(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
