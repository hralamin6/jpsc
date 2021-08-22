<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('quantity')->nullable();
            $table->float('kg');
            $table->float('unit_price');
            $table->float('total_price');
            $table->float('paid_price')->default(0);
            $table->float('due_price');
            $table->string('status')->default('inactive');
            $table->string('price_status')->default('unpaid');
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
        Schema::dropIfExists('sells');
    }
}
