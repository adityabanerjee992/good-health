<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      
      Schema::create('order_details', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('product_code',20);
            $table->string('product_name',50);
            $table->integer('quantity')->unsigned();
            $table->float('price');
            $table->timestamps();

            $table->foreign('order_id')
                  ->references('id')->on('orders')
                  ->onDelete('cascade');
        });



     DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_details');
    }
}
