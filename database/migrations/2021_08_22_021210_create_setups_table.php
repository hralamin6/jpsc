<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setups', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('active');
            $table->string('logo')->default('http://lorempixel.com/300/100/nature/6/');
            $table->string('site_name')->nullable()->default('Site name');
            $table->string('site_url')->nullable()->default('https://jpsc.heroquapp.com');
            $table->string('admin')->nullable()->default('Admin');
            $table->string('email')->nullable()->default('hralamin2002@gmail.com');
            $table->string('phone')->nullable()->default('01254789559');
            $table->string('location')->nullable()->default('dhaka, Bangladesh');
            $table->string('facebook')->nullable()->default('http://facebook.com');
            $table->string('twitter')->nullable()->default('http://twitter.com');
            $table->string('youtube')->nullable()->default('http://youtube.com');
            $table->string('about')->nullable()->default('asdfa saerawerfasdfadsf');
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
        Schema::dropIfExists('setups');
    }
}
