<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {      
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');

      Schema::create('orders', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('store_id')->unsigned()->nullable();
            $table->integer('address_id')->unsigned()->nullable();
            $table->string('token',100)->unique();
            $table->float('order_total')->unsigned();
            $table->integer('payment_type_id')->unsigned()->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('billing_address')->nullable();
            $table->text('reject_reason')->nullable();
            $table->integer('order_status')->unsigned();
            $table->timestamps();

            $table->foreign('payment_type_id')
                  ->references('id')
                  ->on('payment_types');

            $table->foreign('store_id')
                  ->references('id')
                  ->on('stores');               

            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers');

            $table->foreign('address_id')
                  ->references('id')
                  ->on('addresses');

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
       DB::statement('SET FOREIGN_KEY_CHECKS = 0');
       Schema::drop('orders');
       DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
