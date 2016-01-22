<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('class', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('class_name',50)->unique();
            $table->timestamps();
        });

        Schema::create('product_classes',function(Blueprint $table)
        {           
            $table->integer('classes_id')->unsigned()->index();
          
            $table->foreign('classes_id')->references('id')
                  ->on('class')
                  ->onDelete('cascade');

           $table->integer('product_id')->unsigned()->index();
            
           $table->foreign('product_id')->references('id')
                  ->on('products')
                  ->onDelete('cascade');
            
            $table->timestamps();
        });

        Schema::create('classes_salt',function(Blueprint $table)
        {           
            $table->integer('classes_id')->unsigned()->index();
          
            $table->foreign('classes_id')->references('id')
                  ->on('class')
                  ->onDelete('cascade');

           $table->integer('salt_id')->unsigned()->index();
            
           $table->foreign('salt_id')->references('id')
                  ->on('salts')
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

            Schema::drop('class');
            Schema::drop('product_classes');
            Schema::drop('classes_salt');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }
}
