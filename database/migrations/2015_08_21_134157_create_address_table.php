<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::create('addresses', function (Blueprint $table) {
       
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->string('name',50);
            $table->integer('pincode')->nullable();
            $table->text('address',200)->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('phone',20);
            $table->string('country',20)->nullable();
            $table->timestamps();

            $table->foreign('customer_id')
              ->references('id')
              ->on('customers')
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
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('addresses');
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
