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
            $table->string('logo')->nullable();
            $table->string('site_name')->nullable()->default('Site name');
            $table->string('site_url')->nullable()->default('http://hrablog.com');
            $table->string('admin')->nullable()->default('Admin');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('facebook')->nullable()->default('http://facebook.com');
            $table->string('twitter')->nullable()->default('http://twitter.com');
            $table->string('youtube')->nullable()->default('http://youtube.com');
            $table->text('about')->nullable();
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
