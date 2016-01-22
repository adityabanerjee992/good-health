<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('packings', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('packing_type',50)->unique();
            $table->timestamps();
        });

        Schema::create('product_packing',function(Blueprint $table)
        {          
            $table->integer('packing_id')->unsigned()->index();
          
            $table->foreign('packing_id')->references('id')
                  ->on('packings')
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

        Schema::drop('packings');  
        Schema::drop('product_packing');  

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
