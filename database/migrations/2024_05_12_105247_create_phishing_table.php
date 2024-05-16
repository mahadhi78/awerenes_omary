<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhishingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('status', 20);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('temp_name', 100);
            $table->longText('info');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('phishings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compaign_id')->references('id')->on('compaigns')->onDelete('cascade');
            $table->foreignId('template_id')->references('id')->on('templates')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('clicked')->default(false);
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
        Schema::dropIfExists('compaigns');
        Schema::dropIfExists('templates');
        Schema::dropIfExists('phishings');
        Schema::dropIfExists('phishing_sent');
    }
}
