<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      
      Schema::create('payment_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
            $table->text('description');
            $table->float('fee');
            $table->timestamps();
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
        Schema::drop('payment_types');
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
