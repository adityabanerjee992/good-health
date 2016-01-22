<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('units', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('unit_type',50)->unique();
            $table->timestamps();
            
        });

        Schema::create('product_unit',function(Blueprint $table)
        {
  
            $table->integer('unit_id')->unsigned()->index();
          
            $table->foreign('unit_id')->references('id')
                  ->on('units')
                  ->onDelete('cascade');
        
            $table->integer('product_id')->unsigned()->index();
            
            $table->foreign('product_id')->references('id')
                  ->on('products')
                  ->onDelete('cascade');   
          
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

        Schema::drop('units');
        Schema::drop('product_unit');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
