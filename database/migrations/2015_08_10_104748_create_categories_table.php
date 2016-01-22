<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('categories', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('category_name')->unique();
            $table->timestamps();
        });

        Schema::create('product_category',function(Blueprint $table)
        {            
            $table->integer('category_id')->unsigned()->index();
          
            $table->foreign('category_id')->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
          
            $table->integer('product_id')->unsigned()->index();
            
            $table->foreign('product_id')->references('id')
                  ->on('products')
                  ->onDelete('cascade'); 
            $table->timestamps();
        });
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::statement('SET FOREIGN_KEY_CHECKS = 0');
       
       Schema::drop('categories');
       Schema::drop('product_category');
       
       DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }
}
