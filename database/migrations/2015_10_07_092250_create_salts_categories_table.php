<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaltsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('salt_categories', function($table) {
            $table->increments('id');
            $table->string('name',50)->index();
            $table->timestamps();
        });

        Schema::create('salt_category_pivot', function($table) {
             $table->integer('salt_id')->unsigned()->index();
          
            $table->foreign('salt_id')->references('id')
                  ->on('salts')
                  ->onDelete('cascade');
           
            $table->integer('salt_category_id')->unsigned()->index();
            
            $table->foreign('salt_category_id')->references('id')
                  ->on('salt_categories')
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
        Schema::drop('salt_categories');
        Schema::drop('salt_category_pivot');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
